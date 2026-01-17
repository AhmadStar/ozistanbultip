<template>
    <div class="form-group row">
      <label :for="componentName" class="col-6 themed-grid-col"
        >Media ID dd</label
      >
      <span :id="componentName">{{ displayText }}</span>
      {{ formData }}
    </div>
  </template>

  <script>
  export default {
    props: ["formData", "componentName", "displayText"],
  };
  </script>
