<template>
  <div id="app" class="shards-app-promo-page--1">
    <div class="welcome d-flex justify-content-center flex-column">
      <navigation></navigation>
      <inner-wrapper></inner-wrapper>
    </div>
    <feature-section></feature-section>
    <testimonials></testimonials>
    <blog></blog>
    <subscribe></subscribe>
    <contact></contact>
  </div>
</template>

<script>
import Navigation from "./components/Navigation";
import InnerWrapper from "./components/InnerWrapper";
import FeatureSection from "./components/FeatureSection";
import Blog from "./components/Blog";
import Contact from "./components/Contact";
import Subscribe from "./components/Subscribe";
import Testimonials from "./components/Testimonials";

export default {
  components: {
    Navigation,
    InnerWrapper,
    FeatureSection,
    Blog,
    Contact,
    Subscribe,
    Testimonials
  },
  data() {
    return {
      title: "dynamic title",
      component: "form-two"
    };
  },
  methods: {
    updateTitle: function(e) {
      this.title = e;
    }
  },
  created: function() {}
};
</script>

<style scoped>

.shards-app-promo-page--1 .welcome {
  background-color: #37517e;
  background: none;
}

.shards-app-promo-page--1 .welcome:before{
  background: #37518e;
}
</style>
