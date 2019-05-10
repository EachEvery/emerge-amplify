<template>
  <div class="text-center">
    <span
      class="font-sans font-semibold text-black uppercase tracking-wide text-base transition-slow"
      :style="{'color': category.color}"
    >{{category.name}}</span>
  </div>
</template>

<script>
export default {
  props: {
    category: {
      type: Object,
      required: true
    }
  }
};
</script>
