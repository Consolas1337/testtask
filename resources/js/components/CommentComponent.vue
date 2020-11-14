<style lang="scss">

// Main colors
$mainLight: #c9c9cb;
$nonHoveredGray: #797983;
$hoverButtonBackground: #000000;
$pageBackground: #0e0e10;
$projectBackground: #17171a;
$green: #37ad6d;
$red: #d42c2c;

.comment {
  padding: 30px 0px 0px 45px;
  .comment-body {
    display: flex;
    // margin-bottom: 20px;
    .avatar {
      float: left;
      flex-grow: 0;
      vertical-align: top;
      img {
        border-radius: 50%;
      }
    }
    .avatar-comment-wrapper {
      width: 20px;
      flex-grow: 0;
      flex-shrink: 0;
    }
    .main {
      flex-grow: 1;
      float: right;
      .top-info {
        display: inline-block;
        width: 100%;
        font-size: 130%;
        color: $nonHoveredGray;
        .username {
          display: inline-block;
          font-weight: 800;
          letter-spacing: 0.7px;
        }
        .time-ago {
          display: inline-block;
          letter-spacing: 0.75px;
        }
        .time-ago::before {
          $icon-size: 22px;
          content: '';
          display: inline-block;
          vertical-align: middle;
          background-image: url('/css/icons/access_time-24px.svg');
          background-size: $icon-size $icon-size;
          height: $icon-size;
          width: $icon-size;
          margin: 0 7px 0 3px;
        }
        .reply-btn {
          display: inline-block;
          cursor: pointer;
          margin-left: 16px;
        }
        .reply-btn::before {
          $icon-size: 22px;
          content: '';
          display: inline-block;
          vertical-align: middle;
          background-image: url('/css/icons/reply-24px.svg');
          background-size: $icon-size $icon-size;
          height: $icon-size;
          width: $icon-size;
          margin: 0px 5px;
        }
        .share-btn {
          display: inline-block;
          cursor: pointer;
          vertical-align: text-top;
          margin: 0 5px 0 23px;
            .share-icon {
              pointer-events: none;
            }
        }
        .block-btn {
          display: inline-block;
          cursor: pointer;
          vertical-align: text-top;
          .block-icon {
            pointer-events: none;
          }
        }
        .likes-container {
          float: right;
          .like-btn {
            display: inline-block;
            cursor: pointer;
            margin: 0 5px;
            .like-icon {
              vertical-align: text-top;
              transform: rotate(180deg);
              pointer-events: none;
            }
          }
          .liked {
            .like-icon {
              #like {
                fill: $green;
              }
            }
          }
          .dislike-btn {
            display: inline-block;
            cursor: pointer;
            margin: 0 5px;
            .dislike-icon {
              pointer-events: none;
              vertical-align: text-top;
            }
          }
          .disliked {
            .dislike-icon {
              #dislike {
                fill: $red;
              }
            }
          }
          .likes-label {
            display: inline-block;
          }
        }
      }
      .comm-text {
        display: inline-block;            
        margin-top: 2px;
        color: $mainLight;
        font-size: 150%;
        letter-spacing: 1.22px;
      }
    }
  }
}
.nested {
  border-left: 3px solid #39393e;
  margin-left: 30px;
  padding-top: 45px;
}
.first {
  padding: 30px 40px 30px 40px;
}
.nest-limit {
  padding-left: 0;
}
</style>

<template>
  <div class="comment" v-bind:class="{ 'first': !comment.parent_id, 'nested': (comment.parent_id && nestCount <= 5),'nest-limit': nestCount > 5}">
    <div class="comment-body">
      <div class="avatar">
        <img src="https://via.placeholder.com/60">
      </div>
      <div class="avatar-comment-wrapper"></div>
      <div class="main">
        <div class="top-info">
          <div class="username">{{ comment.user }}</div>
          <div class="time-ago"><timeago :datetime="comment.created_at"></timeago></div>
          <div class="reply-btn" @click="$emit('pushParent', comment)">ответить</div>
          <div class="share-btn">
            <object type="image/svg+xml" data="/css/icons/share-24px.svg" width="18" height="18" class="share-icon"></object>
          </div>
          <div class="block-btn">
            <object type="image/svg+xml" data="/css/icons/block-24px.svg" width="18" height="18" class="block-icon"></object>
          </div>
          <div class="likes-container">
            <div class="like-btn" v-bind:class="{ 'liked': comment.action === 1 }" @click="like(comment)">
              <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="like-icon"><path d="M0 0h24v24H0V0zm0 0h24v24H0V0z" fill="none"/>
              <path id="like" d="M15 3H6c-.83 0-1.54.5-1.84 1.22l-3.02 7.05c-.09.23-.14.47-.14.73v2c0 1.1.9 2 2 2h6.31l-.95 4.57-.03.32c0 .41.17.79.44 1.06L9.83 23l6.59-6.59c.36-.36.58-.86.58-1.41V5c0-1.1-.9-2-2-2zm0 12l-4.34 4.34L12 14H3v-2l3-7h9v10zm4-12h4v12h-4z" fill="#797983"/></svg>
              <!-- <object type="image/svg+xml" data="/css/icons/thumb-24px.svg" width="24" height="24" class="like-icon"></object> -->
            </div>
            <div class="dislike-btn" v-bind:class="{ 'disliked': comment.action === -1 }" @click="dislike(comment)">
              <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="dislike-icon"><path d="M0 0h24v24H0V0zm0 0h24v24H0V0z" fill="none"/>
              <path id="dislike" d="M15 3H6c-.83 0-1.54.5-1.84 1.22l-3.02 7.05c-.09.23-.14.47-.14.73v2c0 1.1.9 2 2 2h6.31l-.95 4.57-.03.32c0 .41.17.79.44 1.06L9.83 23l6.59-6.59c.36-.36.58-.86.58-1.41V5c0-1.1-.9-2-2-2zm0 12l-4.34 4.34L12 14H3v-2l3-7h9v10zm4-12h4v12h-4z" fill="#797983"/></svg>
              <!-- <object type="image/svg+xml" data="/css/icons/thumb-24px.svg" width="24" height="24" class="dislike-icon"></object> -->
            </div>
            <div class="likes-label" v-bind:class="{ 'green': comment.likes > 0, 'red': comment.likes < 0, }">{{ comment.likes }}</div>
          </div>
        </div>
        <div class="comm-text">
          {{ comment.text }}
        </div>
      </div>
    </div>
    <div v-if="comment.childs && comment.childs.length">
      <CommentComponent  v-for="comment in comment.childs" :comment="comment" :nestCount="nestCount + 1" :key="comment.id" @pushParent='pushParent'></CommentComponent>
    </div>
  </div>
</template>

<script>
export default {
  name: "CommentComponent",
  methods: {
    like(comm_obj) {
      if (comm_obj.action === 1) {return;}
      axios
        .post("api/comments/like", {"id": comm_obj.id})
        .then(
          r => {
            if (comm_obj.action === -1) {
              comm_obj.action = 0;
            } else {
              comm_obj.action = 1;
            }
            comm_obj.likes += 1;
          },
          e => {
            console.log(e.data.message);
          }
      );
    },
    dislike(comm_obj) {
      if (comm_obj.action === -1) {return;}
      axios
        .post("api/comments/dislike", {"id": comm_obj.id})
        .then(
          r => {
            if (comm_obj.action === 1) {
              comm_obj.action = 0;
            } else {
              comm_obj.action = -1;
            }
            comm_obj.likes -= 1;
          },
          e => {
            console.log(e.data.message);
          }
        );
    },
    pushParent(comment) {
      window.location.href = "#comment-box";
      this.$emit("pushParent", comment);
    },
  },
  props: {
    comment: Object,
    nestCount: Number,
    parentComment: Object,
  },

}
</script>