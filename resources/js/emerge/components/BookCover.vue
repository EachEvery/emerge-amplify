<template>
  <div class="text-center flex flex-column justify-center">
    <span class="font-serif font-normal text-3xl inline-block leading-normal px-4">
      <slot name="title"/>
    </span>
    <br>
    <span class="font-sans font-semibold text-black uppercase tracking-wide">
      <slot name="subtitle"/>
    </span>
  </div>
</template>