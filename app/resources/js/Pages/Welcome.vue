<script setup>
import { ref, provide, onMounted } from 'vue';
import Calculator from '@/Components/Calculator/Index.vue';

const isDark = ref(false);

const toggleTheme = () => {
    isDark.value = !isDark.value;
    document.documentElement.classList.toggle('dark', isDark.value);
    localStorage.setItem('theme', isDark.value ? 'dark' : 'light');
};

onMounted(() => {
    isDark.value = localStorage.getItem('theme') === 'dark';
    document.documentElement.classList.toggle('dark', isDark.value);
});

provide('isDark', isDark);
provide('toggleTheme', toggleTheme);
</script>

<template>
    <div class="flex flex-col items-center justify-center h-screen transition-colors relative"
         :class="isDark ? 'bg-gray-900 text-white' : 'bg-gray-50 text-black'">

        <button 
            @click="toggleTheme" 
            class="p-2 mb-4 border rounded"
            :class="isDark ? 'bg-gray-800 text-white' : 'bg-gray-200 text-black'"
        >
            Switch to {{ isDark ? 'Light' : 'Dark' }} Mode
        </button>

        <Calculator />
        
    </div>
</template>
