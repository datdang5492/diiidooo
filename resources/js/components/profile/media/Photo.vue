<template>
    <div class="col-md-7 profile_detail">
        <div class="row mb-3 section_title">
            <div class="col-md-12">
                <label>Profile Photo</label>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="pd10">
                    <input type="file" @change="onFileChange" />
                    <div class="profile_picture">
                        <img class="rounded-circle" v-if="url" :src="url" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "photo",
        components: {},
        data() {
            return {
                url: 'https://content-static.upwork.com/uploads/2014/10/01073427/profilephoto1.jpg'
            }
        },
        methods: {
            onFileChange(e) {
                const file = e.target.files[0];
                this.url = URL.createObjectURL(file);
            }
        }
    };
</script>

<style scoped>
    .profile_picture {
        /*max-height: 241px;*/
    }

    .profile_picture img {
        /*max-width: 50%;*/
        /*height: auto*/
        max-height: 240px;
    }
</style>
