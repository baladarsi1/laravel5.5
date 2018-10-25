<template>
    <div>
        <div class="form-group">
            <router-link to="/uploadImage" class="btn btn-success">Upload new image</router-link>
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
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" v-on:click="renameImage(image.id, index)">Rename</a></li>
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
    </div>
</template>

<script>

    export default {
        data: function () {
            return {
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
            renameImage(id, index) {
                alert("rename"+id);
            },
            deleteImage(id, index) {
                alert("delete"+id);
            }
        }
    }

</script>