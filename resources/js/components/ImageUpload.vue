<template>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
        </div>
        <div class="custom-file">
            <input type="file" class="custom-file-input" accept="image/*" @change="onChange">
            <label class="custom-file-label">Choose file</label>
        </div>
    </div>
    <!--<input type="file" accept="image/*" @change="onChange">-->
</template>

<script>
    export default {
        methods: {
            onChange(e) {
                if (! e.target.files.length) return;
                let file = e.target.files[0];
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = e => {
                    let src = e.target.result;
                    this.$emit('loaded', { src, file });
                };
            }
        }
    }
</script>