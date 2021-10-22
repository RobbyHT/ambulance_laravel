<template>
  <div class="main">
    <div class="item-row">
      <!--<div class="col-lg-6">
        <div class="news text-center">
          <span class="title">公告</span>
          <div class="content">
            <table class="table">
              <tbody>
                <tr>
                  <td style="width: 7%;" class="text-center">
                    <input type="checkbox" id="news0" name="news[]" value="0" style="vertical-align:sub;zoom:150%;">
                  </td>
                  <td style="width: 13%;" class="text-center">
                    <span style="color: #FEA115">消息</span>
                  </td>
                  <td style="width: 50%;">
                    <a class="text-element" style="display: block;" href="javascript:void(0);">110年度產業工作環境改善計畫-風險技術研習活動</a>
                  </td>
                  <td style="width: 30%;" class="text-right">2021-10-14</td>
                </tr>
                <tr>
                  <td style="width: 7%;" class="text-center">
                    <input type="checkbox" id="news0" name="news[]" value="0" style="vertical-align:sub;zoom:150%;">
                  </td>
                  <td style="width: 13%;" class="text-center">
                    <span style="color: #FEA115">消息</span>
                  </td>
                  <td style="width: 50%;">
                    <a class="text-element" style="display: block;" href="javascript:void(0);">109年度產業工作環境改善計畫-風險技術研習活動</a>
                  </td>
                  <td style="width: 30%;" class="text-right">2020-10-14</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>-->
      <div class="col-lg-8">
        <div class="calender text-center">
          <span class="title">派車行事曆</span>
          <div class="content">
            <FullCalendar :options="calendarOptions" :events="events" />
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="news left_wrap">
          <div class="toptitle align-items-center">
            <div class="left align-items-center">
              <i class="fas fa-bullhorn mr-2"></i>最新消息
            </div>
            <button class="newsAdd" data-toggle="modal" data-target="#newsModal" @click="newsView = 'add'">新增</button>
          </div>
          <ul ref="root">
            <li v-for="news in newsData" :key="news.id">
              <a href="javascript:void(0);" data-toggle="modal" data-target="#newsModal" @click="newsView = 'upd'; newsId = news.id;">
                <span class="badge badge-warning mr-1">消息</span>
                <div class="top justify-content-start">
                  <div class="title">{{ news.title }}</div>
                </div>
                <div class="bottom">{{ news.created_at }}</div>
              </a>
            </li>
            <!--<li>
              <a href="javascript:void(0);" data-toggle="modal" data-target="#newsModal" @click="newsView = 'upd'; newsId = 2;">
                <span class="badge badge-warning mr-1">消息</span>
                <div class="top justify-content-start">
                  <div class="title">(更新轉知)臺南市政府開設臺南園區大型疫苗接種站</div>
                </div>
                <div class="bottom">2021-10-19 14:07:34</div>
              </a>
            </li>-->
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="newsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title col-form-label" id="exampleModalCenterTitle">最新消息</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="news-body">
          <NewsAdd v-if="newsView === 'add'" />
          <NewsUpd v-if="newsView === 'upd'" :newsId="newsId" />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import '@fullcalendar/core/vdom' // solves problem with Vite
  import FullCalendar from '@fullcalendar/vue3'
  import dayGridPlugin from '@fullcalendar/daygrid'
  import interactionPlugin from '@fullcalendar/interaction'
  import '/css/home.css'
  import NewsAdd from './news/news_add.vue'
  import NewsUpd from './news/news_upd.vue'
  export default {
    components: {
      FullCalendar,
      NewsAdd,
      NewsUpd
    },
    data() {
      return {
        newsView: "",
        newsId: "",
        newsData: [],
        eventData: [],
        calendarOptions: {
          plugins: [ dayGridPlugin, interactionPlugin ],
          initialView: 'dayGridMonth',
          dateClick: this.handleDateClick,
          events: [],
          eventClick: function(event) {
            console.log(event.event.title);
          }
        }
      }
    },
    methods: {
      handleDateClick: function(arg) {
        alert('date click! ' + arg.dateStr)
      },
      getEvents: function () {
        axios.get('/api/getEvents')
          .then(resp => (this.calendarOptions.events = resp.data))
          .catch(err => console.log(err.response.data));
      },
      getAllNews: function() {
        var vm = this;

        vm.$loader.show({
          container: this.$refs.root
        });
        axios.get('/api/news')
          .then(function (resp) {
            vm.newsData = resp.data;
            vm.$loader.hide();
          })
          .catch(function (error) {
            console.log(error);
          });
      }
    },
    /*created: function() {
      this.getAllNews();
      this.getEvents();
    },*/
    mounted() {        
      this.getAllNews();
      this.getEvents();
    }, 
  }
</script>