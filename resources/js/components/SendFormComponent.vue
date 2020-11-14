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

input:focus, textarea:focus, select:focus{
  outline: none;
}

%input {
  border: 0;
  background-color: #2b2c32;
  color: #acacac;
  padding: 10px 15px;
  font-family: 'Roboto', sans-serif;
  font-size: 125%;
  margin-bottom: 10px;
}
.new-comment {
  display: flex;
  flex-direction: column;
  margin: 20px 40px;
  .top {
    .input-name {
      @extend %input;
      width: 30%;
    }
    .reply-label {
      font-size: 125%;
      color: #acacac;
      margin-left: 15px;
      // $mainLight
    }
  }
  .main {
    display: flex;
    flex-direction: column;
    .input-comment {
      @extend %input;
      width: 100%;
    }
    .submit-btn {
      background-color: $green;
      border: none;
      color: white;
      padding: 16px 32px;
      text-decoration: none;
      cursor: pointer;
    }
  }
}
</style>

<template>
  <div class="new-comment" id="comment-box">
    <div class="top">
      <input type="text" size="40" class="input-name" v-model="name" placeholder="Ваш никнейм"><span class="reply-label" v-if="parent_comment.id">Ответ пользователю: <b>{{ parent_comment.user }}</b></span>
    </div>
    <div class="main">
      <textarea name="comment" cols="40" rows="5" class="input-comment" v-model="text" placeholder="Ваш комментарий"></textarea>
      <input type="button" value="Отправить" class="submit-btn" v-on:click="sendComment">
    </div>
  </div>
</template>

<script>
export default {
  name: "SendFormComponent",
  props: {
    parent_comment: Object,
  },
  data:() => ({
    name: "",
    text: "",
    parent: {
      id: "",
      name: null,
    },
    formData: {},
  }),
  methods: {
    sendComment() {
      this.formData = {
        name: this.name,
        text: this.text,
        parent_id: this.parent_comment.id,
      };
      axios
        .post("api/comments/post-comment", this.formData)
        .then(
          r => {
            this.$emit("updateComments");
            this.name = "";
            this.text = "";
            this.parent = {};
          },
          e => {
            console.log(e.data);
          },
      );
    },
  },
}
</script>