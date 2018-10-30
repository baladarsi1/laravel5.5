
<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">Rename Image</div>
            <div class="panel-body">
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Image name</label>
                            <span>{{ message }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        data: function () {
            return {
                message: 'not updated'
            }
        },
    }
</script>
