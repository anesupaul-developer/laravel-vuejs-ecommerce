<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, router, usePage} from '@inertiajs/vue3';
import Subscription from "@/Components/Subscription.vue";

const page = usePage();

function submit() {
  router.post('/customer/apply-account', {});
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
      <section v-if="$page.props.auth.user.is_admin_panel_user !== 2" class="bg-center bg-no-repeat bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/conference.jpg')] bg-gray-700 bg-blend-multiply">
        <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
          <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">We invest in the world’s potential</h1>
          <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">Apply for an account.</p>
          <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
            <form @submit.prevent="submit">
              <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-md w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="submit">Apply Now
              </button>
            </form>
          </div>
        </div>
      </section>

      <section v-if="$page.props.approval_status === 'pending' && $page.props.customer">
        <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
          <div class="p-4 mb-4 text-xl text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            <span class="font-medium">Account application is currently pending.</span>
          </div>
        </div>
      </section>

      <section v-if="$page.props.customer && $page.props.approval_status === 'complete'">
        <Subscription model-value=""/>
      </section>
    </AuthenticatedLayout>
</template>
