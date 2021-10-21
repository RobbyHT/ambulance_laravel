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
          <div class="toptitle d-flex align-items-center">
            <i class="fas fa-bullhorn mr-2"></i>最新消息
            <!--<div class="right d-flex align-items-stretch">
              <a href="#" target="_self" style="color: black; font-size: 8px;">篩選</a>
            </div>-->
          </div>
          <ul>
            <li>
              <a href="https://ers.stsp.gov.tw/news/82">
                <span class="badge badge-warning mr-1">消息</span>
                <div class="top d-flex justify-content-start">
                  <div class="title">轉知臺南市政府第一劑BNT疫苗預約接種資訊</div>
                </div>
                <div class="bottom">2021-10-21 09:13:58</div>
              </a>
            </li>
            <li>
              <a href="https://ers.stsp.gov.tw/news/81">
                <span class="badge badge-warning mr-1">消息</span>
                <div class="top d-flex justify-content-start">
                  <div class="title">(更新轉知)臺南市政府開設臺南園區大型疫苗接種站</div>
                </div>
                <div class="bottom">2021-10-19 14:07:34</div>
              </a>
            </li>
          </ul>
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
  export default {
    components: {
      FullCalendar // make the <FullCalendar> tag available
    },
    data() {
      return {
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
    },
    created: function() {
      this.getEvents();
    }
  }
</script>