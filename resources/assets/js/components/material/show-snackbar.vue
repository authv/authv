<template>
    <div></div>
</template>

<script>
  export default {
      props: {
        message: {
          required: true
        },
        timeout: {
          required: false,
          default: 2000
        },
        actionText: {
          required: false
        },
        actionHandler: {
          required: false
        }
      },

      ready: function() {
        setTimeout(() => {
          this.$parent.$refs.abc.show(this.message, this.timeout, this.actionText, this.actionHandler);
        }, 2000);
      }
  }
</script>
