<template>
    <div class="menu_srch d-flex" @click="showSearch = !showSearch">
        <i class="fa fa-search search_btn"></i>
        <!-- SEARCH INPUT -->
        <div class="header_serch" v-if="showSearch">
            <div class="header_serch_input">
                <input type="" name="" placeholder="Search">
            </div>
            <div class="header_serch_i">
                <i class="fa fa-search"></i>
            </div>
        </div>
        <!-- SEARCH INPUT -->
    </div>
</template>

<script>
    export default {
        data(){
            return {
                showSearch : false,
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
