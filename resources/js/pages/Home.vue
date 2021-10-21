<template>
  <div class="main">
    <div class="item-row">
      <div class="col-lg-6">
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
      </div>
      <div class="col-lg-6">
        <div class="calender text-center">
          <span class="title">派車行事曆</span>
          <div class="content">
            <FullCalendar :options="calendarOptions" :events="events" />
          </div>
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