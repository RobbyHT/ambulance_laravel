<style scoped>
  @import '/css/home.css';
  .outside {
    position: relative;
  }
  .del_news {
    position: absolute;
    top: 0;
    left: 0;
    color: #ffffff;
    padding: 0;
    width: 3vmin;
    height: 3vmin;
    background: #ff0000;
    border-radius: 50%;
    border: 0;
    font-size: 3vmin;
    font-family: none;
    font-weight: bold;
  }
  .del_news:hover {
    background: #960101;
  }
  .del_news span {
    position: absolute;
    top: -1vmin;
    right: 0.6vmin;
  }
</style>
<template>
  <div class="main">
    <div class="item-row">
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
            <li v-for="(news, index) in newsData" :key="news.id" class="outside">
              <button type="button" class="del_news" value="1" @click="delNews(index)">
                <span>×</span>
              </button>
              <a href="javascript:void(0);" data-toggle="modal" data-target="#newsModal" @click="newsView = 'upd'; newsId = news.id;">
                <span class="badge badge-warning mr-1">消息</span>
                <div class="top justify-content-start">
                  <div class="title">{{ news.title }}</div>
                </div>
                <div class="bottom">{{ news.created_at }}</div>
              </a>
            </li>
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
          <NewsUpd v-if="newsView === 'upd'" :newsId="newsId" :key="newsId" />
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
  import listPlugin from '@fullcalendar/list'
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
          headerToolbar : {
            end: 'prevYear,prev today next,nextYear,dayGridMonth,listMonth',
            //center: 'title',
            start: 'title',
          },
          /*header: { // 頂部排版
            left: "prev,next today", // 左邊放置上一頁、下一頁和今天
            center: "title", // 中間放置標題
            right: "month,agendaWeek,agendaDay,listMonth" // 右邊放置月、周、天
          },*/
          plugins: [ dayGridPlugin, interactionPlugin, listPlugin ],
          initialView: 'listMonth',
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
      },
      delNews: function(index) {
        var vm = this;
        axios.post(`/api/news/${vm.newsData[index].id}`, {
          _method: 'DELETE'
        })
        .then(function (resp) {
          vm.newsData.splice(index, 1);
        })
        .catch(function (error) {
          console.log(error);
        });
      },
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