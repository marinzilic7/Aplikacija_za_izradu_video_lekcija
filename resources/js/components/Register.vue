<template>
    <v-sheet width="300" class="mx-auto">
        <v-form fast-fail @submit.prevent>
            <v-text-field
                v-model="firstName"
                label="First name"
                :rules="firstNameRules"
            ></v-text-field>

            <v-text-field
                v-model="lastName"
                label="Last name"
                :rules="lastNameRules"
            ></v-text-field>
            <v-text-field
                v-model="email"
                label="Email"
                :rules="emailRules"
            ></v-text-field>
            <v-text-field
                v-model="password"
                label="Password"
                :rules="passwordRules"
            ></v-text-field>
            <v-text-field
                v-model="passwordCheck"
                label="Repeat Password"
                :rules="passwordRules"
            ></v-text-field>

            <v-btn type="submit" block class="mt-2">Submit</v-btn>
        </v-form>
    </v-sheet>
</template>

<script setup></script>

<style lang="scss" scoped></style>
