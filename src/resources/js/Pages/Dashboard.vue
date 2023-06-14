<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, router, useForm, usePage} from '@inertiajs/vue3';
import Subscription from "@/Components/Subscription.vue";
import {ref} from "vue";
import SubscriptionPayment from "@/Components/SubscriptionPayment.vue";
import InputError from "@/Components/InputError.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Modal from "@/Components/Modal.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ActionButton from "@/Components/ActionButton.vue";

const page = usePage();

let subscription = ref(null);
let showModal = ref(false);

const form = useForm({
  cc_number: '',
  cc_cvc: '',
  cc_expiry_month: '',
  cc_expiry_year: '',
  subscription_id: subscription?.id
});

function submit() {
  router.post('/customer/apply-account', {});
}

const closeModal = () => {
  showModal.value = false;
  form.reset();
};

function addPaymentForm(sub) {
  subscription.value = sub;
  form.subscription_id = sub.id;
  showModal.value = true;
}

function subscribeCustomer() {
  form.post('customer/subscription', {
    onError: params => {
      console.log(params);
    }
  });
}
</script>

<template>
  <Head title="Dashboard"/>

  <AuthenticatedLayout>
    <!--      <template #header>-->
    <!--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>-->
    <!--      </template>-->

    <section v-if="$page.props.auth.user.is_admin_panel_user !== 2"
             class="bg-center bg-no-repeat bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/conference.jpg')] bg-gray-700 bg-blend-multiply">
      <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">We
          invest in the world’s potential</h1>
        <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">Apply for an account.</p>
        <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
          <form @submit.prevent="submit">
            <button
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-md w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="submit">Apply Now
            </button>
          </form>
        </div>
      </div>
    </section>

    <section v-if="$page.props.approval_status === 'pending' && $page.props.customer">
      <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
        <div class="p-4 mb-4 text-xl text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
             role="alert">
          <span class="font-medium">Account application is currently pending.</span>
        </div>
      </div>
    </section>

    <section v-if="$page.props.customer && $page.props.approval_status === 'complete'">
      <Subscription :subscriptions="$page.props.subscriptions" @subscriberSelected="addPaymentForm"/>
    </section>

    <!--     <section v-if="$page.props.customer && $page.props.approval_status === 'complete' && subscription">-->
    <!--       <SubscriptionPayment :subscription="subscription"/>-->
    <!--     </section>-->

    <Modal :show="showModal" @close="closeModal">
      <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">
          Subscribe to start creating your account and add products to your store
        </h2>

        <p class="mt-1 text-sm text-gray-600">
          Please not that a charge of ${{ subscription.price }} will be deducted from your account.
        </p>

        <div class="mt-3">
          <form @submit.prevent="subscribe" class="space-y-8">
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
              <div class="w-full">
                <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Credit Card
                  Number</label>
                <input type="password" name="cc_number" id="cc_number" v-model="form.cc_number"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                       placeholder="XXXX-XXX-XXX-XXX-XXX" required="">
              </div>
              <div class="w-full">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CVC</label>
                <input type="number" name="cc_cvc" id="cc_cvc" v-model="form.cc_cvc"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                       placeholder="XXX" required="">
              </div>
              <div class="w-full">
                <label for="item-weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Expiry
                  Year</label>
                <input type="number" name="cc_expiry_year" id="cc_expiry_year" v-model="form.cc_expiry_year"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                       placeholder="12" required="">
              </div>

              <div class="w-full">
                <label for="item-weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Expiry
                  Month</label>
                <input type="number" name="cc_expiry_month" id="cc_expiry_month" v-model="form.cc_expiry_month"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                       placeholder="12" required="">
              </div>
            </div>

            <div class="mt-6 flex justify-end">
              <DangerButton @click="closeModal"> Cancel</DangerButton>

              <ActionButton
                  class="ml-3"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                  @click="subscribeCustomer"
              >
                Proceed with payment
              </ActionButton>
            </div>
          </form>
        </div>
      </div>
    </Modal>
  </AuthenticatedLayout>
</template>
