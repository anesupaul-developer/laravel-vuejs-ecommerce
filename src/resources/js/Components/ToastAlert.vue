<script setup>
import {onMounted, onUnmounted, ref} from 'vue';
import ToastListItem from "@/Components/ToastListItem.vue";
import {Inertia} from "@inertiajs/inertia";
import {usePage} from "@inertiajs/vue3";
import toast from "@/Stores/toast.js";

const props = defineProps({
  message: String
});

const page = usePage();

const inertiaEventListener = Inertia.on('finish', () => {
  if (page.props.toast) {
      toast.add(page.props.toast.message, page.props.toast.bgColor);
  }
});

onUnmounted(() => inertiaEventListener());
</script>

<template>
  <TransitionGroup
      tag="div"
      enter-active-class="duration-500"
      enter-from-class="translate-x-full opacity:0"
      leave-active-class="duration-500"
      leave-to-class="translate-x-full opacity:0"
      class="fixed top-16 right-4 z-50 w-full max-w-xs">
    <ToastListItem
        v-for="(item, index) in toast.items"
        :key="item.key"
        @remove="toast.remove(index)"
        :baseColor="item.color"
        :message="item.message"/>
  </TransitionGroup>
</template>