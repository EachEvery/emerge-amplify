<template>
  <div
    class="flex flex-col h-screen bg-green-lightest justify-center px-6 text-center leading-normal"
  >
    <div
     class="illustration"

    ></div>
    <h1
      class="font-serif text-3xl self-center mt-8 leading-normal "
      style="max-width: 300px;"
    >Please visit us on your laptop or desktop</h1>
    <p
      class="leading-normal self-center text-lg mt-2"
      style="max-width: 330px;"
    >Emerge is an innovative digital experience not optimized for mobile devices.</p>
  </div>
</template>

<style lang="scss" scoped>
.illustration {
  width: 60%;
  margin: 0px auto;
  height: 30%;
  background-position: center center;
  background-image: url("/images/no-mobile.png");
  background-size: contain;
  background-repeat: no-repeat;
}

</style>