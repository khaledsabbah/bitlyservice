<template>
    <div>
        <heading class="mb-6">Shorten URL</heading>

        <div class="card">
            <div class="flex border-b border-40">
                <div class="w-1/5 py-6 px-8">
                    <label for="Long Link" class="inline-block text-80 pt-2 leading-tight">
                        Long Link
                    </label>
                </div>
                <div class="py-6 px-8 w-1/2">
                    <input id="long_url" dusk="long_url" type="text" placeholder="Long Link"
                           class="w-full form-control form-input form-input-bordered" v-model="long_url">
                    <div class="help-text help-text mt-2"></div>
                </div>
            </div>

            <div class="flex border-b border-40">
                <div class="w-1/5 py-6 px-8">
                    <label for="Bitly Link" class="inline-block text-80 pt-2 leading-tight">
                        Title
                    </label>
                </div>
                <div class="py-6 px-8 w-1/2">
                    <input id="title" dusk="title" type="text" placeholder="Bitly Link"
                           class="w-full form-control form-input form-input-bordered" v-model="title">
                    <div class="help-text help-text mt-2"></div>
                </div>
            </div>

            <div class="flex items-center">
                <button class="btn btn-default btn-primary inline-flex items-center relative"
                        @click="registerLinkWithBitly" dusk="create-button">
                    <span class=""> Create Bitly Link</span>
                </button>
            </div>

        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import Vue from 'vue';
    import VueSweetalert2 from 'vue-sweetalert2';
    import 'sweetalert2/dist/sweetalert2.min.css';

    Vue.use(VueSweetalert2);

    export default {
        data() {
            return {
                title: '',
                long_url: '',
                bitly_link:''
            }
        },
        mounted() {

        },

        methods: {
            // getData: async function () {
            //     // Default options are marked with *
            //     const response = await fetch('https://api-ssl.bitly.com/v4/bitlinks/bit.ly/shorten_ur_jira',
            //         {
            //             method: 'GET', // *GET, POST, PUT, DELETE, etc.
            //             cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            //             headers: {
            //                 'Content-Type': 'application/json',
            //                 Authorization: `Bearer ${process.env.MIX_BITLY_OAUTH_KEY}`,
            //             },
            //             redirect: 'follow', // manual, *follow, error
            //             referrer: 'no-referrer', // no-referrer, *client
            //         });
            //     return await response; // parses JSON response into native JavaScript objects
            // },
            postData: async function (url = '', data = {}) {

                // const response = await fetch(url, {
                //     method: 'POST',
                //     cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                //     headers: {
                //         'Content-Type': 'application/json',
                //         Authorization: `Bearer ${process.env.MIX_BITLY_OAUTH_KEY}`,
                //     },
                //     redirect: 'follow', // manual, *follow, error
                //     referrer: 'no-referrer', // no-referrer, *client
                //     body: JSON.stringify(data) // body data type must match "Content-Type" header
                // });
                // return await response.json(); // parses JSON response into native JavaScript objects

                const headers = {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${process.env.MIX_BITLY_OAUTH_KEY}`,
                };

                return axios.post(url, data, {
                    headers: headers
                })
            },
            registerLinkWithBitly: function () {
                this.postData("https://api-ssl.bitly.com/v4/bitlinks", {
                    "title": this.title,
                    "long_url": this.long_url,
                    // "domain": "bit.ly",
                    // "group_guid": "string",
                    // "tags": [
                    //     "string"
                    // ],
                    // "deeplinks": [
                    //     {}
                    // ],
                }).then(response => {
                    let res = JSON.parse(JSON.stringify(response))
                    console.log(document.getElementsByTagName('header'))
                    console.log(res)
                    res = res.data
                    Vue.swal({
                        title: res.link,
                        text: ``,
                        confirmButtonText: 'Ok',
                        confirmButtonColor: '#91c18e'
                    });
                }).catch(err => {
                    let error = JSON.parse(JSON.stringify(err))
                    error = error.response.data
                    Vue.swal( error.message, error.description, 'error')
                });
            }
            ,
            preparetitle: function () {
                return "http://bit.ly/" + this.title;
            }
        }
    }
</script>

<style>
    /* Scoped Styles */
</style>
