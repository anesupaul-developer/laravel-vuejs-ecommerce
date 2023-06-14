<script setup>
import {onMounted, reactive, ref, watch} from 'vue';
import {router} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Modal from "@/Components/Modal.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";

const props = defineProps({
  subscriptions: Array,
});

</script>

<template>
  <div class="flex items-center justify-center bg-[#000]">
    <!-- Button 1 -->
    <div class="mx-auto max-w-screen-xl px-4 py-8 lg:px-6 lg:py-16">
      <div class="mx-auto mb-8 max-w-screen-md  lg:mb-12 text-center">
        <h2 class="mb-10 text-6xl font-bold tracking-tight text-black uppercase">Pay once, use forever</h2>
      </div>
      <div class="space-y-8  lg:grid md:grid-cols-3 lg:space-y-0 lg:gap-10">
        <section v-for="subscription in props.subscriptions">
          <div class="mx-auto flex max-w-lg space-y-8 items-start flex-col rounded-3xl border border-gray-200 p-6 text-gray-900 xl:p-8" :class="`bg-${subscription.color_code}-500`">

            <h3 class="text-lg font-normal ">{{subscription.name}}</h3>
            <div class="my-8 flex items-baseline justify-center ">
              <span class="mr-2 text-5xl font-extrabold">${{subscription.price}}</span>
              <span class="text-gray-600">/month</span>
            </div>

            <p class="font-light text-black sm:text-sm">{{subscription.description}}</p>
            <button @click="$emit('subscriberSelected', subscription)"
                    class="cursor-pointer bg-gray-900 w-full rounded-md  p-3 text-center text-sm font-semibold text-white shadow-sm ">
              Get started
            </button>
            <!-- List -->
            <ul role="list" class="mb-8 space-y-4 text-left text-gray-600  text-sm">
              <li class="flex items-center space-x-3 ">
                <!-- Icon -->
                <svg class="h-5 w-5 flex-shrink-0 bg-gray-900 rounded-full p-0.5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                <span>10,000 visitors</span>
              </li>
              <li class="flex items-center space-x-3">
                <!-- Icon -->
                <svg class="h-5 w-5 flex-shrink-0 bg-gray-900 rounded-full p-0.5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                <span>Unlimited widgets</span>
              </li>
              <li class="flex items-center space-x-3">
                <!-- Icon -->
                <svg class="h-5 w-5 flex-shrink-0 bg-gray-900 rounded-full p-0.5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                <span>All analytics features</span>
              </li>
              <li class="flex items-center space-x-3">
                <!-- Icon -->
                <svg class="h-5 w-5 flex-shrink-0 bg-gray-900 rounded-full p-0.5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                <span>Priority support</span>
              </li>
              <li class="flex items-center space-x-3">
                <!-- Icon -->
                <svg class="h-5 w-5 flex-shrink-0 bg-gray-900 rounded-full p-0.5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                <span>Lifetime updates</span>
              </li>
            </ul>
          </div>
        </section>
      </div>
    </div>
  </div>
</template>
