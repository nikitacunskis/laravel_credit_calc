<script setup>
import { ref, computed, defineProps, defineEmits } from 'vue';
import { inject, watch } from 'vue';

const isDark = inject('isDark', false);

const props = defineProps({
    min: {
        type: Number,
        required: true
    },
    max: {
        type: Number,
        required: true
    },
    image: {
        type: String,
        required: true
    },
    defaultValue: {
        type: Number,
        required: true
    },
    label: {
        type: String,
        required: true
    }
});

const emit = defineEmits(['update:value']);

const value = ref(props.defaultValue || props.min);

const position = computed(() => {
    return ((value.value - props.min) / (props.max - props.min)) * 100;
});

watch(value, (newValue) => {
    if (newValue < props.min) {
        value.value = props.min;
    } else if (newValue > props.max) {
        value.value = props.max;
    }
    emit('update:value', value.value);
});
</script>

<template>
    <div 
        class="flex flex-col items-center w-full"
        :class="isDark ? 'text-white' : 'text-black'"
    >
        <div class="border-b-2"
            :class="isDark ? 'border-gray-300' : 'border-gray-600'"
        >
            <input
                id="amount"
                type="text" 
                v-model="value" 
                class="text-center text-lg bg-transparent border-none focus:outline-none"
                style="font-size: 1.5em;"
            />
        </div>
        <label style="font-size: 0.75em;" for="amount">{{ label }}</label>
        <div class="relative w-full">
            <div class="grid grid-cols-12 items-center w-full">
                <span class="col-span-1 text-lg text-right translate-y-1/4 mr-2">{{ min }}</span>
                <div class="relative col-span-10 w-full h-9">
                    <input 
                        type="range" 
                        :min="min" 
                        :max="max" 
                        v-model="value"
                        class="w-full absolute appearance-none h-12 bg-transparent rounded-lg outline-none z-20 cursor-pointer" 
                    />
                    <div class="absolute top-0 w-full pointer-events-none z-10">
                        <img 
                            :src="image" 
                            :style="{ left: `calc(${position}% - 12px)` }"
                            class="absolute w-8 h-8 translate-y-1/4"
                        />
                    </div>
                    <div 
                        class="absolute w-full top-4 h-4 bg-white rounded-lg"
                    ></div>
                    <div 
                        class="absolute w-full top-4 h-4 bg-black rounded-lg pr-1"
                        :style="{ width: `${position}%` }"
                    ></div>
                </div>
                <span class="ml-2 col-span-1 text-lg text-left translate-y-1/4">{{ max }}</span>
            </div>
        </div>
    </div>
</template>

<style>
input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    width: 0;
    height: 0;
}
input[type="range"]::-moz-range-thumb {
    opacity: 0;
    width: 0;
    height: 0;
    border: none;
}
</style>