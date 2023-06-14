<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import UpdateProfileInformationForm from "@/Pages/Profile/Partials/UpdateProfileInformationForm.vue";
import DeleteUserForm from "@/Pages/Profile/Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "@/Pages/Profile/Partials/UpdatePasswordForm.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";

const props = defineProps({});
</script>

<template>
  <Head title="StoreAccount" />

   <AuthenticatedLayout>
     <div class="py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
         <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
           <section>
             <header>
               <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>

               <p class="mt-1 text-sm text-gray-600">
                 Update your account's profile information and email address.
               </p>
             </header>
           </section>
         </div>
       </div>
     </div>
   </AuthenticatedLayout>
</template>
