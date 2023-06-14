<script setup>
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
  subscription: Object
});

const form = useForm({
  cc_number: '5333 09090 090 090',
  cc_cvc: '717',
  cc_expiry_month: '08',
  cc_expiry_year: '25',
  subscription_id: props.subscription.id
});

function subscribe() {
  form.post('/customer/subscription', {});
}

</script>

<template>
  <div class="flex items-center justify-center bg-[#FFFFFF]">
    <!-- Button 1 -->
    <div class="mx-auto max-w-screen-xl px-4 py-8 lg:px-6 lg:py-16">
      <div class="mx-auto max-w-screen-md text-center">
        <h2 class="mb-10 text-6xl font-bold tracking-tight text-black uppercase">Pay once, use forever</h2>
      </div>

      <section class="bg-white dark:bg-gray-900">
        <div class="px-4 mx-auto max-w-screen-md">
          <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Subscription Payment</h2>
          <p class="mb-8 lg:mb-16 font-light text-center text-gray-500 dark:text-gray-400 sm:text-xl">Got a technical issue? Want to send feedback about a beta feature? Need details about our Business plan? Let us know.</p>
          <form @submit.prevent="subscribe" class="space-y-8">
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
              <div class="w-full">
                <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Credit Card Number</label>
                <input type="password" name="cc_number" id="cc_number" v-model="form.cc_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="XXXX-XXX-XXX-XXX-XXX" required="">
              </div>
              <div class="w-full">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CVC</label>
                <input type="number" name="cc_cvc" id="cc_cvc" v-model="form.cc_cvc" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="XXX" required="">
              </div>
              <div class="w-full">
                <label for="item-weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Expiry Year</label>
                <input type="number" name="cc_expiry_year" id="cc_expiry_year" v-model="form.cc_expiry_year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="12" required="">
              </div>

              <div class="w-full">
                <label for="item-weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Expiry Month</label>
                <input type="number" name="cc_expiry_month" id="cc_expiry_month" v-model="form.cc_expiry_month" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="12" required="">
              </div>
            </div>
            <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
              Subscribe
            </button>
          </form>
        </div>
      </section>
    </div>
  </div>
</template>
