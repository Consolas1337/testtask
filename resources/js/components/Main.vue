<style lang="scss">
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');

// Main colors
$mainLight: #c9c9cb;
$nonHoveredGray: #797983;
$hoverButtonBackground: #000000;
$pageBackground: #0e0e10;
$projectBackground: #17171a;
$green: #37ad6d;
$red: #d42c2c;

body {
  background-color: $pageBackground;
  scroll-behavior: smooth;
}

.red {
  transition: 0.33s ease-in;
  color: $red;
}

.green {
  transition: 0.33s ease-in;
  color: $green;
}

.comments-container {
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: $pageBackground;
  height: auto;
  font-family: 'Roboto', sans-serif;
  .comments {
    background-color: $projectBackground;
    width: 1300px;
    // height: 1080px; 
    .hat {
      height: 95px;
      .label-block {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        width: 19%;
        vertical-align: top;
        .label-text {
          color: $mainLight;
          display: block;
          font-size: 200%;
          font-weight: 500;
          letter-spacing: 1px;
        }
        .label-text:any-link {
          text-decoration: none;
          color: $mainLight;
        }
        .label-text:hover {
          text-decoration: none;
        }
      }
      .sort-block {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        margin-left: 25px;
        letter-spacing: 0.4px;
        
        .sort_btn {
          vertical-align: bottom;
          display: inline-block;
          margin-right: 17px;
        }
        .sort_btn input[type=radio] {
          display: none;
        }
        .sort_btn label {
          display: inline-block;
          cursor: pointer;
          padding: 4px 13px;
          line-height: 34px;
          border-radius: 6px;
          user-select: none;
          margin: 0 0;
          color: #797983;
          font-size: 135%;
        }
        
        .sort_btn input[type=radio]:checked + label {
          background: #1f1f23;
          color: $mainLight;
        }
        
        .sort_btn label:hover {
          color: $mainLight;
        }
      }
      .rules-block {
        float: right;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        width: 13.7%;
        .rules-label {
          font-size: 135%;
          letter-spacing: 0.6px;
          color: $nonHoveredGray;
        }
        .rules-label:any-link {
          text-decoration: none;
          color: $mainLight;
        }
        .rules-label:hover {
          text-decoration: none;
        }
        .rules-label::before {
          $icon-size: 20px;
          content: '';
          display: inline-block;
          vertical-align: middle;
          background-image: url('/css/icons/info-black-18dp.svg');
          background-size: $icon-size $icon-size;
          height: $icon-size;
          width: $icon-size;
          margin: 0 5px 4px 7px;
        }
      }
    }
    .body {
      border-bottom: 1px solid #39393e;
    }
  }
}
</style>

<template>
  <div class="comments-container">
    <div class="comments">
      <div class="hat">
        <div class="label-block">
          <a class="label-text">Комментарии</a>
        </div>
        <div class="sort-block">
          <div class="sort_btn">
            <input id="sort_btn1" v-model="radio" @click="sortByPopular(comments)" type="radio" name="radio" value="1" checked>
            <label for="sort_btn1">Популярные</label>
          </div>
          <div class="sort_btn">
            <input id="sort_btn2" v-model="radio" @click="sortByNew(comments)" type="radio" name="radio" value="2">
            <label for="sort_btn2">Новые</label>
          </div>
          <div class="sort_btn">
            <input id="sort_btn3" v-model="radio" @click="sortByOld(comments)" type="radio" name="radio" value="3">
            <label for="sort_btn3">Старые</label>
          </div>
        </div>
        <div class="rules-block">
          <a class="rules-label">Правила</a>
        </div>
      </div>
      <div class="body">
        <CommentComponent 
          v-for="comment in comments" 
          :comment="comment"
          :nestCount="nestCount"
          :key="comment.id" 
          @pushParent='replyComment'
        ></CommentComponent>
      </div>
      <SendFormComponent 
        @updateComments="getComments"
        v-bind:parentComment.sync="parentComment"
      ></SendFormComponent>
    </div>
  </div>
</template>

<script>
import CommentComponent from "./CommentComponent.vue"
import SendFormComponent from "./SendFormComponent.vue"

  export default {
    data:() => ({
      radio: 0,
      comments: [],
      comment: [],
      formData: [],
      parentComment: null,
      nestCount: 0,
      rawComments: [],
    }),
    methods: {
      qwe(comm) {
        comm.childs = this.rawComments.filter(comment => comment.parent_id === comm.id);
        this.rawComments = this.rawComments.filter(x => !comm.childs.includes(x));
        comm.childs.forEach(el => {
          this.qwe(el, comm)
        });
      },
      getComments() {
        axios
          .get("api/comments/get-all")
          .then(
            r => {
              this.rawComments = r.data.data;
              this.comments = this.rawComments.filter(comment => comment.parent_id === null);
              this.rawComments = this.rawComments.filter(x => !this.comments.includes(x));
              this.comments.forEach(el => {
                this.qwe(el);
              });
            },
            e => {
              console.log(e.data);
            }
          );
      },
      replyComment(data) {
        window.location.href = "#comment-box";
        this.parentComment = data;
      },
      sortByPopular(arr) {
        arr.sort(function(a,b){
          return b.likes - a.likes;
        });
        arr.forEach(el => {
          this.sortByPopular(el.childs);
        });
      },
      sortByNew(arr) {
        arr.sort(function(a,b){
          return new Date(b.created_at) - new Date(a.created_at);
        });
        arr.forEach(el => {
          this.sortByNew(el.childs);
        });
      },
      sortByOld(arr) {
        arr.sort(function(a,b){
          return new Date(a.created_at) - new Date(b.created_at);
        });
        arr.forEach(el => {
          this.sortByOld(el.childs);
        });
      },
    },
    mounted() {
      this.getComments();
    },
  components: {
    CommentComponent,
    SendFormComponent,
  },

  }
</script>
