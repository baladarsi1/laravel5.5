<!-- template for the modal component -->
<script type="x/template" id="modal-template">
    <transition name="modal">
        <div class="modal-mask" v-show="show">
            <div class="modal-container">
                <div class="modal-header">
                    <h3>New Post</h3>
                </div>
                <div class="modal-body">
                    <label class="form-label">
                        Title
                        <input class="form-control">
                    </label>
                    <label class="form-label">
                        Body
                        <textarea rows="5" class="form-control"></textarea>
                    </label>
                </div>
                <div class="modal-footer text-right">
                    <button class="modal-default-button" @click="savePost()">
                    Save
                    </button>
                </div>
            </div>
        </div>
    </transition>
</script>


<!-- app -->
<div id="app">
    <modal :show="showModal" @close="showModal = false"></modal>
    <button id="show-modal" @click="showModal = true">New Post</button>
</div>

