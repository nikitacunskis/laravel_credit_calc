<script setup>
import { computed } from 'vue';

const props = defineProps({
    amount: {
        type: Number,
        required: true
    },
    time: {
        type: Number,
        required: true
    }
});

const montlyPayment = computed(() => {
    return (props.amount / props.time).toFixed(2);
});

</script>
<template>
    <div style="font-size: 2em;">
        {{ montlyPayment }} €
    </div>
    <div>
        * mēneša minimālais maksājums
    </div>
</template>