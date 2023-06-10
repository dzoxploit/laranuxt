<script setup lang="ts">
//meta title
useHead({
  title: "Edit a Post - Didinnuryahya.com",
});

//init config
const config = useRuntimeConfig();

//init router
const router = useRouter();

//init route
const route = useRoute();

//fetch daa for get detail data post
const { data: post }: any = await useFetch(
  `${config.public.apiBase}/api/post/show/${route.params.id}`
);

//define state
const title = ref(post.value.data.title);
const description = ref(post.value.data.description);
const errors: any = ref({});

//method for handle file changes
const handleFileChange = (e: any) => {
  //assign file to state
  image.value = e.target.files[0];
};

//method "updatePost"
const updatePost = async () => {
  //init formData
  let formData = new FormData();

  //assign state value to formData
  formData.append("title", title.value);
  formData.append("description", description.value);
  formData.append("_method", "PATCH");

  //store data with API
  await $fetch(`${config.public.apiBase}/api/post/update/${route.params.id}`, {
    //method
    method: "POST",

    //data
    body: formData,
  })
    .then(() => {
      //redirect
      router.push({ path: "/posts" });
    })
    .catch((error) => {
      //assign response error data to state "errors"
      errors.value = error.data;
    });
};
</script>

<template>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 rounded shadow">
          <div class="card-body">
            <form @submit.prevent="updatePost()">
              <div class="mb-3">
                <label class="form-label fw-bold">Title</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="title"
                  placeholder="Title Post"
                />
                <div v-if="errors.title" class="alert alert-danger mt-2">
                  <span>{{ errors.title[0] }}</span>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Description</label>
                <textarea
                  class="form-control"
                  v-model="description"
                  rows="5"
                  placeholder="Description Post"
                ></textarea>
                <div v-if="errors.description" class="alert alert-danger mt-2">
                  <span>{{ errors.description[0] }}</span>
                </div>
              </div>
              <button
                type="submit"
                class="btn btn-md btn-primary rounded-sm shadow border-0"
              >
                Update
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
