<script setup lang="ts">
import { inject, ref } from 'vue';
import Slider from './Slider.vue';
import Result from './Result.vue';
import Form from './Form.vue';

const isDark = inject('isDark', false);

const handleAmountChange = (newValue) => {
    amount.value = newValue;
};

const handleTimeChange = (newValue) => {
    time.value = newValue;
};

const amount = ref(3500);
const time = ref(60);

</script>

<template>
    <div class="flex items-center justify-center w-full md:w-1/2">
        <div 
            class="grid grid-cols-1 gap-4 w-full rounded-lg p-12 m-4 transition-all duration-300"
            :class="isDark ? 'bg-dark-gradient text-white' : 'bg-light-gradient text-black'"
        >
            <div class="row">
                <div class="text-center">
                    <Result 
                        :amount="amount" 
                        :time="time"
                    />
                </div>
            </div>
            <hr :class="isDark ? 'border-gray-300' : 'border-gray-600'" />
            <div class="row">
                <Slider 
                    :min="100" 
                    :max="25000" 
                    :image="'/icons/coin.png'" 
                    :defaultValue="amount" 
                    :label="'SUMMA (€)'"
                    @update:value="handleAmountChange"
                />
            </div>
            <div class="row">
                <Slider 
                    :min="6" 
                    :max="72" 
                    :image="'/icons/time.png'" 
                    :defaultValue="time" 
                    :label="'TERMIŅŠ (MĒN)'" 
                    @update:value="handleTimeChange"
                />
            </div>
            <hr :class="isDark ? 'border-gray-300' : 'border-gray-600'" />
            <Form 
                :amount="amount"
                :time="time"
            />
        </div>
    </div>
</template>

<style scoped>
.bg-light-gradient {
  background: linear-gradient(to right, #d1d1d1, #b3b3b3);
}

.bg-dark-gradient {
  background: linear-gradient(to right, #4f4f4f, #242424);
}
</style>
