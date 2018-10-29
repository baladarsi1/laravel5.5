<template>
    <div>
        <div class="form-group">
            <button id="show-modal" @click="showModal = true">Upload new image</button>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Images list</div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Thumb</th>
                        <th widht="100">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="image, index in images">
                        <td>{{ image.id }}</td>
                        <td>{{ image.image_name }}</td>
                        <td><img :src="'images/thumbs/'+image.image_name"></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" id="menu1" type="button" data-toggle="dropdown">Dropdown Example
                                    <span class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" v-on:click="shareImage(image.id, index)">Share</a></li>
                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1" :href="'images/'+image.image_name" download>
                                            Download
                                        </a>
                                    </li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" v-on:click="renameImage(image.id, index, image.image_name)">Rename</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" v-on:click="deleteImage(image.id, index)">Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <!-- use the modal component, pass in the prop -->
            <modal v-if="showModal" @close="showModal = false">

               <h3 slot="header">custom header</h3>
            </modal>
        </div>

    </div>
</template>

<script>

    export default {
        data() {
            return {
                showModal: false,
                images: []
            }
        },
        mounted() {
            var app = this;
            axios.get('/user/images')
                .then(function (resp) {
                    app.images = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("could not load images");
                })
        },
        methods: {
            shareImage(id, index) {
                alert("share"+id);
            },
            renameImage(id, index, imageName) {
                this.showModal = true;

            },
            deleteImage(id, index) {
                alert("delete"+id);
            },
            submitRenameImage() {
                event.preventDefault();
                var app = this;
                var newCompany = app.company;
                axios.patch('/api/v1/companies/' + app.companyId, newCompany)
                    .then(function (resp) {
                        app.$router.replace('/');
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your company");
                    });
            }
        }
    }

</script>