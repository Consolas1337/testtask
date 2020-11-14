<style lang="scss">
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');

// Main colors
$mainLight: #c9c9cb;
$nonHoveredGray: #797983;
$hoverButtonBackground: #000000;
$pageBackground: #0e0e10;
$projectBackground: #17171a;


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
    height: 1080px; 
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
      .comment {
        padding: 30px 0px 0px 45px;
        .comment-body {
          display: flex;
          margin-bottom: 20px;
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
                vertical-align: text-top;
                margin: 0 5px 0 23px;
              }
              .block-btn {
                display: inline-block;
                vertical-align: text-top;
              }
              .likes-container {
                float: right;
                .like-btn {
                  display: inline-block;
                  margin: 0 5px;
                  .like {
                    vertical-align: text-top;
                    transform: rotate(180deg);
                  }
                }
                .dislike-btn {
                  display: inline-block;
                  margin: 0 5px;
                  .dislike {
                    vertical-align: text-top;
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
        margin: 12px 0 0 30px;
      }
      .first {
        padding: 30px 40px 30px 40px;
      }
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
            <input id="sort_btn1" type="radio" name="radio" value="1">
            <label for="sort_btn1">Популярные</label>
          </div>
          <div class="sort_btn">
            <input id="sort_btn2" type="radio" name="radio" value="2">
            <label for="sort_btn2">Новые</label>
          </div>
          <div class="sort_btn">
            <input id="sort_btn3" type="radio" name="radio" value="3">
            <label for="sort_btn3">Старые</label>
          </div>
        </div>
        <div class="rules-block">
          <a class="rules-label">Правила</a>
        </div>
      </div>
      <div class="body">
        <div class="comment first">
          <div class="comment-body">
            <div class="avatar">
              <img src="https://via.placeholder.com/60">
            </div>
            <div class="avatar-comment-wrapper"></div>
            <div class="main">
              <div class="top-info">
                <div class="username">{{ comments[0].user }}</div>
                <div class="time-ago">2 час. назад</div>
                <div class="reply-btn">ответить</div>
                <div class="share-btn">
                  <object type="image/svg+xml" data="/css/icons/share-24px.svg" width="18" height="18"></object>
                </div>
                <div class="block-btn">
                  <object type="image/svg+xml" data="/css/icons/block-24px.svg" width="18" height="18"></object>
                </div>
                <div class="likes-container">
                  <div class="like-btn">
                    <object type="image/svg+xml" data="/css/icons/thumb-24px.svg" width="24" height="24" class="like"></object>
                  </div>
                  <div class="dislike-btn">
                    <object type="image/svg+xml" data="/css/icons/thumb-24px.svg" width="24" height="24" class="dislike"></object>
                  </div>
                  <div class="likes-label">{{ comments[0].likes }}</div>
                </div>
              </div>
              <div class="comm-text">
                {{ comments[0].text }}
              </div>
            </div>
          </div>
          
          <div class="comment nested">
            <div class="comment-body">
              <div class="avatar">
                <img src="https://via.placeholder.com/60">
              </div>
              <div class="avatar-comment-wrapper"></div>
              <div class="main">
                <div class="top-info">
                  <div class="username">{{ comments[0].childs[0].user }}</div>
                  <div class="time-ago">2 час. назад</div>
                  <div class="reply-btn">ответить</div>
                  <div class="share-btn">
                    <object type="image/svg+xml" data="/css/icons/share-24px.svg" width="18" height="18"></object>
                  </div>
                  <div class="block-btn">
                    <object type="image/svg+xml" data="/css/icons/block-24px.svg" width="18" height="18"></object>
                  </div>
                  <div class="likes-container">
                    <div class="like-btn">
                      <object type="image/svg+xml" data="/css/icons/thumb-24px.svg" width="24" height="24" class="like"></object>
                    </div>
                    <div class="dislike-btn">
                      <object type="image/svg+xml" data="/css/icons/thumb-24px.svg" width="24" height="24" class="dislike"></object>
                    </div>
                    <div class="likes-label">{{ comments[0].childs[0].likes }}</div>
                  </div>
                </div>
                <div class="comm-text">
                  {{ comments[0].childs[0].text }}
                </div>
              </div>
            </div>
            <div class="comment nested">
              <div class="comment-body">
                <div class="avatar">
                  <img src="https://via.placeholder.com/60">
                </div>
                <div class="avatar-comment-wrapper"></div>
                <div class="main">
                  <div class="top-info">
                    <div class="username">{{ comments[0].childs[0].childs[0].user }}</div>
                    <div class="time-ago">2 час. назад</div>
                    <div class="reply-btn">ответить</div>
                    <div class="share-btn">
                      <object type="image/svg+xml" data="/css/icons/share-24px.svg" width="18" height="18"></object>
                    </div>
                    <div class="block-btn">
                      <object type="image/svg+xml" data="/css/icons/block-24px.svg" width="18" height="18"></object>
                    </div>
                    <div class="likes-container">
                      <div class="like-btn">
                        <object type="image/svg+xml" data="/css/icons/thumb-24px.svg" width="24" height="24" class="like"></object>
                      </div>
                      <div class="dislike-btn">
                        <object type="image/svg+xml" data="/css/icons/thumb-24px.svg" width="24" height="24" class="dislike"></object>
                      </div>
                      <div class="likes-label">{{ comments[0].childs[0].childs[0].likes }}</div>
                    </div>
                  </div>
                  <div class="comm-text">
                    {{ comments[0].childs[0].childs[0].text }}
                  </div>
                </div>
              </div>
            </div> 
          </div>     
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data:() => ({
      comments: [],
    }),
    methods: {
      getComments() {
        axios
          .get("api/comments/get-all")
          .then(
            r => {
              console.log(r.data);
              this.comments = r.data.data;
            },
            e => {
              console.log(e.data);
            }
          );
      }
    },
    mounted() {
      this.getComments();
    }
  }
</script>
