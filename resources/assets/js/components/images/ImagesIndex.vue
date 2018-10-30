<template>
    <div>
        <div class="form-group">
            <button id="show-modal" data-toggle="modal" data-target="#imageUploadModal">Upload new image</button>
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
                                    <li role="presentation"><a role="menuitem" tabindex="-1" data-toggle="modal" :data-target="'#myShareModal' + image.id">Share</a></li>
                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1" :href="'images/'+image.image_name" download>
                                            Download
                                        </a>
                                    </li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" @click="openModalGetImage(image.id)" data-toggle="modal" :data-target="'#myRenameModal' + image.id">Rename</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" :data-target="'#myDeleteModal' + image.id">Delete</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Modal -->
                            <div :id="'myShareModal' + image.id" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Share Image</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>This is share model</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- Modal -->
                            <div :id="'myRenameModal' + image.id" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Rename Image</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                <input v-model="updatedImageName" class="form-control" />
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-success"
                                                    data-dismiss="modal"
                                            @click="updateImageName(image.id)">Save Changes</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- Modal -->
                            <div :id="'myDeleteModal' + image.id" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Delete Image</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure, do you want to delete the image?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                            <button type="button" class="btn btn-success"
                                                    data-dismiss="modal"
                                            @click="deleteImage(image.id)">Delete Image</button>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div id="imageUploadModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Upload Image</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card card-default">
                                    <div class="card-header">File Upload Component</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3" v-if="image">
                                                <img :src="image" class="img-responsive" height="70" width="90">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="file" v-on:change="onImageChange" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <button class="btn btn-success btn-block" @click="uploadImage">Upload Image</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" @click="completedImageUpload()">Close</button>
                    </div>
                </div>

            </div>
        </div>

    </div>
</template>

<script>

    export default {
        data: function () {
            return {
                showModal: false,
                showSecondModal: false,
                images: [],
                updatedImageName : '',
                image: ''
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
            onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            uploadImage(){
                axios.post('/image/store',{image: this.image}).then(response => {
                    if (response.data.success) {
                        this.showModal = false;
                        this.$router.push('ImagesIndex')
                    }
                    else{
                        alert(response.data.error);
                    }
                });
            },
            openModalGetImage(id){
                //console.log(id);
                axios.get('/user/image/' + id)
                    .then(response => {
                        console.log(response); // show if success
                        this.updatedImageName = response.data; //we are putting data into our posts array
                    })
                    .catch(function (error) {
                        console.log(error); // run if we have error
                    });
            },
            shareImage(id, index) {
                this.showSecondModal = true;
            },
            renameImage(id, index, imageName) {
                this.showSecondModal = true;
                this.message = 'updated'
            },
            deleteImage(id) {
                axios.post('/user/image/deleteImage/' + id, {

                })
                    .then( (response) =>{
                        if(response.status===200){
                            this.$router.go(0);
                        }
                    })
                    .catch(function (error) {
                        console.log(error); // run if we have error
                    });
            },
            updateImageName(id){
                axios.post('/user/image/updateImageName/' + id, {
                    updatedImageName: this.updatedImageName
                })
                    .then( (response) =>{
                        if(response.status===200){
                            this.$router.go(0);
                        }
                    })
                    .catch(function (error) {
                        console.log(error); // run if we have error
                    });
            },
            completedImageUpload() {
                this.$router.go(0);
            }
        }
    }

</script>