<template>
  <div
    id="speaker"
    class="logo-bg"
  >
    <section class="top container">
      <div class="logo logo-speaker-title" />
      <h2>
        <div class="logo logo-circles logo-circles-l" />
        驅動高速資訊交流圈的 <span>佼佼者們</span>
        <div class="logo logo-circles logo-circles-r" />
      </h2>
      <p>
        每年我們都邀請了超過 25 位講師來到現場，包含知名的前端開發者、軟體工程師、資深架構師、設計師，以及專案經理等等，讓這場活動更加多元，也貫徹 MOPCON 的精神，使參與的會眾都能從中獲得養分，甚至達到近一步的交流。
      </p>
    </section>

    <div class="container">
      <div class="logo logo-hr" />
    </div>

    <section class="content container">
      <h2>開箱 <span>高手陣容</span></h2>
      <ul class="tags-wrap">
        <li
          v-for="(tag, index) in tags"
          :key="`tag-${index}`"
          @click="toggleTag(tag)"
        >
          <button
            class="btn-tag"
            :class="{'active' : activeTags.includes(tag)}"
          >
            <span class="logo logo-check" />
            {{ tag }}
          </button>
        </li>
      </ul>

      <ul v-if="speakers.length" class="speaker-list">
        <li
          v-for="speaker in formatSpeakers"
          :key="speaker.speaker_id"
          @click="handleSpeakerClick(speaker.speaker_id)"
        >
          <div class="speaker-img-wrap">
            <img :src="speaker.img.web" alt="">
          </div>
          <h3>{{ speaker.name }}</h3>
          <p>{{ speaker.company }}</p>
          <div class="speaker-btn-wrap">
            <button
              v-for="(tag, idx) in speaker.tags"
              :key="`tags-${idx}`"
              class="btn-tag btn-tag-outline"
            >
              {{ tag.name }}
            </button>
          </div>
        </li>
      </ul>
    </section>

    <section class="promotion container">
      <div class="promotion-l">
        <h2>\\ 怕錯過感興趣的講者議程嗎？</h2>
        <p>下載 MOPCON App，建立你的行事曆吧！</p>
        <a
          href="https://play.google.com/store/apps/details?id=org.mopcon.session.app"
          target="_blank"
          class="logo logo-google-play"
        />
        <a
          href="https://apps.apple.com/tw/app/mopcon/id721411970"
          target="_blank"
          class="logo logo-app-store"
        />
      </div>
      <div class="promotion-r">
        <div class="logo logo-mobile" />
      </div>
    </section>

    <speaker-dialog :visible.sync="dialogShow" :speaker-info="speakerInfo" />
  </div>
</template>

<script>
import { speaker, tags } from '@/api/url'
import SpeakerDialog from './components/SpeakerDialog'

export default {
  name: 'Speaker',
  components: {
    SpeakerDialog
  },
  async asyncData ({ $axios, route }) {
    try {
      const { data } = await $axios.get(speaker)
      const res = await $axios.get(tags)

      const config = {
        speakers: data.data,
        tags: res.data.data.map(tag => tag.name)
      }
      if (route.params.speaker_id) {
        config.activeSpeaker = +route.params.speaker_id
        config.dialogShow = true
      }
      return config
    } catch (err) {}
  },
  data () {
    return {
      activeTags: [],
      dialogShow: false,
      speakers: [],
      folded: true,
      activeSpeaker: 0,
      tags: []
    }
  },
  computed: {
    formatSpeakers () {
      let formatArr = this.speakers
      if (this.activeTags.length) {
        formatArr = formatArr.filter(speaker => speaker.tags.some(tag => this.activeTags.includes(tag.name)))
      }
      return formatArr
    },
    speakerInfo () {
      return this.speakers.find(speaker => speaker.speaker_id === this.activeSpeaker)
    }
  },
  methods: {
    toggleTag (name) {
      !this.activeTags.includes(name) ? this.activeTags.push(name) : this.activeTags.splice(this.activeTags.indexOf(name), 1)
    },
    handleSpeakerClick (id) {
      this.activeSpeaker = id
      this.dialogShow = true
    }
  },
  head () {
    if (this.$route.params.speaker_id) {
      return {
        title: `${this.speakerInfo.name} | 講者 MOPCON 2020`,
        meta: [
          {
            hid: 'description',
            name: 'description',
            content: this.speakerInfo.summary
          },
          // fb
          {
            hid: 'og-title',
            property: 'og:title',
            content: `${this.speakerInfo.name} | 講者 MOPCON 2020`
          },
          {
            hid: 'og-description',
            property: 'og:description',
            content: this.speakerInfo.summary
          },
          {
            hid: 'og-url',
            property: 'og:url',
            content: `${process.env.BASE_URL}/2020/speaker/${this.speakerInfo.speaker_id}`
          },
          {
            hid: 'og-image',
            property: 'og:image',
            content: `${this.speakerInfo.img.web}`
          },
          // twitter seo
          {
            hid: 'twitter-site',
            name: 'twitter:site',
            content: `${this.speakerInfo.name} | 講者 MOPCON 2020`
          },
          {
            hid: 'twitter-description',
            name: 'twitter:description',
            content: this.speakerInfo.summary
          },
          {
            hid: 'twitter-app:name:iphone',
            name: 'twitter:app:name:iphone',
            content: `${this.speakerInfo.name} | 講者 MOPCON 2020`
          },
          {
            hid: 'twitter-app:name:ipad',
            name: 'twitter:app:name:ipad',
            content: `${this.speakerInfo.name} | 講者 MOPCON 2020`
          }
        ]
      }
    }
  }
}
</script>

<style lang="scss" scoped>
// logo
@import '~@/assets/styles/_mix';
$logo_map: (
  svg: speaker-title check,
  png: mobile google-play app-store
);
@include logo_map_mix(speaker);

#speaker {
  @apply text-white;
}
.container {
  margin: 0 auto;
}
::v-deep > section {
  @apply mx-auto overflow-x-hidden pt-10 pb-12;
  > h2 {
    @apply text-2xl;
  }
  @screen md {
    @apply pt-16 pb-20;
    > h2 {
      @apply text-4xl;
    }
  }
  @screen sm {
    > h2 {
      @apply text-3xl;
    }
  }
}

::v-deep .btn-tag {
  border-radius: 18px;
  padding: 4px 12px;
  opacity: .6;
  @apply outline-none text-sm;
  &.active {
    opacity: 1;
    .logo {
      width: 16px;
      height: 12px;
      @apply inline-block;
    }
  }
}
::v-deep .btn-tag-outline {
  padding: 2px 12px;
  @apply border-2 border-purple-700 mr-4 text-sm;
  &:last-child {
    @apply mr-0;
  }
}

// section
.top {
  @apply flex flex-col justify-center items-center;
  .logo-speaker-title {
    width: 100%;
    height: 250px;
    margin: 0 auto;
  }
  h2 {
    @apply relative mt-16 mb-20 text-center;
    span {
      @apply text-yellow-500 block;
    }
  }
  p {
    width: 90%;
  }
  .logo-circles {
    width: 60px;
    height: 20px;
    &-l {
      left: -25px;
      top: -25px;
    }
    &-r {
      right: -25px;
      bottom: -14px;
    }
  }
  @screen sm {
    p {
      width: 80%;
    }
  }
  @screen md {
    .logo-speaker-title {
      width: 436px;
      height: 279px;
    }
    p {
      width: 65%;
    }
    h2 {
      @include border-primary;
      span {
        @apply inline-block;
      }
    }
    .logo-circles {
      width: 60px;
      height: 10px;
      &-l {
        left: -60px;
        top: -25px;
      }
      &-r {
        right: -75px;
        bottom: -14px;
      }
    }
  }
}

.content {
  @apply flex flex-col justify-center items-center;
  h2 {
    span {
      @apply text-yellow-500;
    }
  }
  .tags-wrap {
    width: 80%;
    @apply flex flex-wrap mt-8 justify-center;
    li {
      @apply mr-4 mb-4;
      &:last-child {
        @apply mr-0;
      }
    }
    .btn-tag {
      @apply bg-purple-700;
    }
  }
  .speaker-list {
    width: 90%;
    @apply flex justify-start px-4 flex-col;
    li {
      @apply flex flex-col items-center pt-10 cursor-pointer;
      &:hover {
        .speaker-img-wrap {
          &::before {
            content: '';
            border-radius: 40px;
            opacity: .7;
            @apply absolute top-0 left-0 w-full h-full z-10 bg-yellow-500;
          }
          &::after {
            content: '- Read more -';
            transform: rotate(-45deg);
            @apply absolute inset-0 text-blue-950 w-full h-full flex items-center justify-center
            font-medium z-10;
          }
        }
      }
    }
    .speaker-img-wrap {
      width: 140px;
      height: 140px;
      transform: rotate(45deg);
      border-radius: 40px;
      @apply border-2 border-white mb-5 relative;
      img {
        object-fit: cover;
        transform: rotate(-45deg);
      }
    }
    h3 {
      @apply text-xl relative mb-5 mt-2;
      &::after {
        content: '';
        bottom: -10px;
        height: 4px;
        @apply absolute inset-x-0 mx-auto bg-yellow-500;
      }
    }
    p {
      color: rgba(242, 242, 247, 0.72);
      @apply text-sm;
    }
    .speaker-btn-wrap {
      @apply flex justify-center flex-wrap;
      .btn-tag-outline {
        @apply mr-2 mt-2;
      }
    }
  }
  @screen md {
    .speaker-list {
      @apply flex-row flex-wrap mt-16;
      li {
        width: 33.33333%;
        @apply mb-6 pb-6;
      }
    }
  }
  @screen xl {
    .speaker-list {
      @apply px-16;
    }
  }
}

.promotion {
  @apply flex pb-0 pt-0 flex-col items-center;
  &-l {
    @apply text-center;
    .logo {
      width: 143px;
      height: 43px;
      background-size: cover;
      @apply inline-block mt-6 mx-2;
    }
  }
  &-r {
    @apply mt-6;
    .logo {
      width: 245px;
      height: 380px;
    }
  }
  h2 {
    @apply text-yellow-500 text-2xl mb-2;
  }
  p {
    @apply text-gray-100;
  }
  @screen md {
    width: 80%;
    @apply flex-row items-start;
    &-l {
      @apply pt-20 mr-24 text-left;
      .logo {
        @apply mr-8 ml-0;
      }
    }
    &-r {
      @apply mt-0;
    }
    h2 {
      @apply text-3xl;
    }
  }
}
</style>
