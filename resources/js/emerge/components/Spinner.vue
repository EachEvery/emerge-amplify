<template>
  <icon :svg="require('spinner.svg')" class="spin"/>
</template>
<script>
import icon from "./Icon";
export default {
  components: {
    icon
  }
};
</script>
<style lang="scss" scoped>
.spin {
  animation: 1s spin infinite;
}

@keyframes spin {
  from {
    transform: rotate(0deg);
  }

  to {
    transform: rotate(360deg);
  }
}
</style>