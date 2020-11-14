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
        .dislike-btn {
            display: inline-block;
            cursor: pointer;
            margin: 0 5px;
            .dislike-icon {
            pointer-events: none;
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
</style>

<template>
  <div class="comment" v-bind:class="{ 'first': !comment.parent_id, 'nested': comment.parent_id, }">
      <div class="comment-body">
      <div class="avatar">
          <img src="https://via.placeholder.com/60">
      </div>
      <div class="avatar-comment-wrapper"></div>
      <div class="main">
          <div class="top-info">
          <div class="username">{{ comment.user }}</div>
          <div class="time-ago">2 час. назад</div>
          <div class="reply-btn">ответить</div>
          <div class="share-btn">
              <object type="image/svg+xml" data="/css/icons/share-24px.svg" width="18" height="18" class="share-icon"></object>
          </div>
          <div class="block-btn">
              <object type="image/svg+xml" data="/css/icons/block-24px.svg" width="18" height="18" class="block-icon"></object>
          </div>
          <div class="likes-container">
              <div class="like-btn">
              <object type="image/svg+xml" data="/css/icons/thumb-24px.svg" width="24" height="24" class="like-icon"></object>
              </div>
              <div class="dislike-btn">
              <object type="image/svg+xml" data="/css/icons/thumb-24px.svg" width="24" height="24" class="dislike-icon"></object>
              </div>
              <div class="likes-label" v-bind:class="{ 'green': comment.likes>0, 'red': comment.likes<0, }">{{ comment.likes }}</div>
          </div>
          </div>
          <div class="comm-text">
          {{ comment.text }}
          </div>
      </div>
      </div>
      <div v-if="comment.childs && comment.childs.length">
        <CommentsComponent  v-for="comment in comment.childs" :comment="comment" :key="comment.id"></CommentsComponent>
      </div>
  </div>
</template>

<script>
export default {
  name: "CommentsComponent",
  props: {
    comment: Object,
  },

}
</script>