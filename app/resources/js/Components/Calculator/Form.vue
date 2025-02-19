<script setup>
import { inject } from "vue";
import { countries } from "@/config/country";
import { validatePhoneNumber } from "@/helpers/phoneValidator";
import { useForm, useField } from "vee-validate";
import * as yup from "yup";

const isDark = inject('isDark', false);

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

const schema = yup.object({
    name: yup.string().required("Jāievada vārds"),
    country: yup.string().oneOf(countries.map((c) => c.short)).required(),
    phone: yup
        .string()
        .required("Jāievada tālrunis")
        .test("isValidPhone", "Tālrunis norādīts nepareizi", (value, context) => {

            return validatePhoneNumber(context.parent.country, value);
        }),
    agree: yup.boolean().oneOf([true], "Jāpiekrīt noteikumiem"),
});

const { handleSubmit, errors } = useForm({ validationSchema: schema });
const { value: name } = useField("name");
const { value: country } = useField("country", undefined, { initialValue: "lv" });
const { value: phone } = useField("phone");
const { value: agree } = useField("agree");

const onSubmit = handleSubmit(async (values) => {

    try {
        const response = await axios.post("/api/step-1/submit", {
            ...values,
            amount: props.amount,
            time: props.time
        });
        alert("Nauda drīz būs tavā kabatā!");
    } catch (error) {
        alert("Radusies kļūda pieprasot naudu.");
    }
});
</script>

<template>
    <form @submit.prevent="onSubmit" class="w-full mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
            <div class="col-span-5">
                <div class="border-b-2"
                    :class="isDark ? 'border-gray-300' : 'border-gray-600'"
                >
                    <input 
                        v-model="name" 
                        type="text" 
                        placeholder="Vārds"
                        class="text-left text-lg bg-transparent border-none w-full focus:outline-none"
                        style="font-size: 1em;"
                    />
                </div>
                <p class="text-red-500 text-sm mt-2">{{ errors.name }}</p>
            </div>

            <div class="col-span-12 md:col-span-7">
                <div class="flex">
                    <div class="border-b-2 w-full"
                        :class="isDark ? 'border-gray-300' : 'border-gray-600'"
                    >
                        <select 
                            v-model="country" 
                            class="text-center text-lg bg-transparent border-none focus:outline-none"
                            style="font-size: 1em;"
                        >
                            <option v-for="c in countries" :key="c.short" :value="c.short">
                                {{ c.code }}
                            </option>
                        </select>
                        <input 
                            v-model="phone" 
                            type="text" 
                            placeholder="Tālrunis"
                            class="text-left text-lg bg-transparent border-none focus:outline-none"
                            style="font-size: 1em;"
                        />
                    </div>
                </div>
                <p class="text-red-500 text-sm mt-2">{{ errors.country }}</p>
                <p class="text-red-500 text-sm mt-2">{{ errors.phone }}</p>
            </div>
        </div>

        <div class="mt-4 flex items-center">
            <label class="block mb-1 flex items-center text-right">
                <span class="mr-2">Piekrītu noteikumiem</span>
                <input v-model="agree" type="checkbox" class="mr-2" />
            </label>
            <p class="text-red-500 text-sm ml-4 mr-2">{{ errors.agree }}</p>
            <button 
                type="submit" 
                class="text-lg p-4 rounded ml-auto w-full"
                :class="isDark ? 'bg-gray-100 text-black' : 'bg-black text-white'"
            >
                <span style="font-size: 1.5em;">SAŅĒMT <b>{{ props.amount }} €</b></span>
            </button>
        </div>
    </form>
</template>
