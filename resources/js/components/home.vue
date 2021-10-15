<template>
  <section class="page-user-profile">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-content">
          <div class="content d-flex flex-column text-break pl-5 pr-5">
            <div class="pt-5">
              <!-- <div class="col-12 mt-1 mb-1 text-left">
                <button type="button" class="btn btn-primary" style="width:200px;height:40px;" onclick="packSFX('{{$user->id}}');">產生金鑰</button>
              </div> -->
              <!-- <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}"> -->
              <div class="dialog-bottom text-center">
                <img width="70px" :src="'/img/最新消息Icon.png'" alt="最新消息" title="最新消息">
                最新消息
              </div>
              <table class="table mb-0 content">
                <thead>
                    <th></th>
                    <th></th>
                    <th colspan="2">
                      <a href="javascript:void(0);" onclick="addtr()">
                        <img width="40px" :src="'img/最新消息新增Icon.jpg'" alt="刪除" title="刪除">
                        新增
                      </a>
                      &nbsp;&nbsp;
                      <a href="javascript:void(0);" onclick="NewsDelBtn()">
                        <img width="40px" :src="'img/最新消息刪除Icon.jpg'" alt="刪除" title="刪除">
                        刪除
                      </a>
                    </th>
                </thead>
                <tbody id="newsTab">
                  <tr id="News" v-for="n in max" :key="n">
                    <td>
                      <label class="container">
                        <input type="checkbox" name="news[]" :id="'chk'+n" value="">
                        <span class="checkmark"></span>
                      </label>
                    </td>
                    <td :id="'newsContent'+n" style="width: 55%;">110年度產業工作環境改善計畫-風險技術研習活動</td>
                    <td :id="'newsDate'+n" style="width: 30%;" align="right">2021-09-08</td>
                    <td :id="'newsControl'+n" style="width: 15%;"><a href="javascript:void(0);" onclick="">編輯</a></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!--<div class="pt-5 text-center">
              <div class="post-slider">
                <h1 class="classText">課程公布</h1>
                <img class="prev" width="70px" src="{{ asset('images/xr/按鈕左.png') }}" alt="按鈕左" title="按鈕左">
                <img class="next" width="70px" src="{{ asset('images/xr/按鈕右.png') }}" alt="按鈕右" title="按鈕右">
                <div id="classes" class="post-wrapper">
                  @forelse ($allclass as $key => $class)
                    <div id="class{{ $key }}" class="post">
                      <input type="hidden" name="hid_name{{ $key }}" id="hid_name{{ $key }}" value="{{ $class->name }}" />
                      <input type="hidden" name="hid_img{{ $key }}" id="hid_img{{ $key }}" value="{{asset('storage/'.$class->image)}}" />
                      <img src="{{asset('storage/'.$class->image)}}" alt="" id="img{{$key}}" class="slider-image" onclick="imgBtn('{{ $key }}')">
                      <input type="file" id="image{{ $key }}" name="image{{ $key }}" accept=".jpg, .jpeg, .png" style="display: none;" onchange="previewFile('{{ $key }}');" disabled>
                      <div id="className{{ $key }}" class="classTitle">
                        {{ $class->name }}
                      </div>
                      <div class="post-info pt-1">
                        <div class="custom-control-inline text-left" style="width: 100%; padding-left: 10px;">
                          <div class="custom-control-inline">
                            <img width="30px" src="{{ asset('images/xr/課程時長Icon.png') }}" alt="課程時長" title="課程時長">
                            &nbsp;
                            課程時長：
                          </div>
                          <div id="classTime{{ $key }}" style="width: 80%;">
                            {{ timeConver($class->total_time) }}
                          </div>
                        </div>
                        <div class="custom-control-inline text-left" style="width: 100%; padding-left: 10px;">
                          <div class="custom-control-inline">
                            <img width="30px" src="{{ asset('images/xr/單元數Icon.png') }}" alt="單元數" title="單元數">
                            &nbsp;
                            單元數：
                          </div>
                          <div id="classUnit{{ $key }}" style="width: 80%;">
                            @if ($class->count_unit != 0)
                              {{ $class->count_unit }}個單元
                            @else
                              尚無單元
                            @endif
                          </div>
                        </div>
                      </div>
                      <div id="classControl{{ $key }}" class="custom-control-inline classControl">
                        <div class="col-6 custom-control-inline text-center classUpd">
                          <a class="classUpdBtn" href="javascript:void(0);" onclick="classUpdBtn('{{ $key }}', '{{ $class->id }}')">
                            編輯
                          </a>
                        </div>
                        <div class="col-6 custom-control-inline text-center classDel">
                          <a class="classDelBtn" href="javascript:void(0);" onclick="classDelBtn('{{ $key }}', '{{ $class->id }}')">
                            刪除
                          </a>
                        </div>
                      </div>
                    </div>
                  @empty
                    <span>尚無消息</span>
                  @endforelse
                </div>
                <div class="text-center">
                  <div class="classIns">
                    <a class="classInsBtn" href="javascript:void(0);" onclick="classAddBtn()">
                      新增
                    </a>
                  </div>
                </div>
              </div>
            </div>-->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</template>

<script>
  export default {
    date() {
      return {
        max: 0,
      }
    },
    created() {
      this.max = 5;
    },
    mounted() {
      console.log('Component mounted.')
    }
  }
</script>