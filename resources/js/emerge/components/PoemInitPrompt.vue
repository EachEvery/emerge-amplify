<template>
  <span class="pulse-in-out inline-block">
    <span :style="currentCategoryColor">*</span>
    <slot/>
    <span :style="currentCategoryColor">*</span>
  </span>
</template>
<script>
export default {
  computed: {
    currentCategoryColor() {
      return {
        color: "var(--category-color)"
      };
    }
  }
};
</script>
