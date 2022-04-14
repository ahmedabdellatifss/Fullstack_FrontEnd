
<template>
  <div>
    <div class="post_dtls_cmnt_sec mar_t20">
      <h2 class="post_dtls_title2 pad_b20">Comments</h2>
      <!-- comment -->
      <div class="cmnt_box_all">
        <div class="cmnt_box_top dis_flx">
          <div class="cmnt_box_top_left d-flex">
            <div class="cmnt_img mar_r15">
              <img src="img/girl-cmnt.jpg" alt="image" />
            </div>
            <div class="cmnnt_name">
              <div class="cmnt_name_left">
                <h4 class="tchr_nam mar_b10">james smith</h4>
              </div>
              <div class="cmnt_name_right">
                <p class="cmnt_name_right_p">05 Nov 2019 AT 12:00 AM</p>
              </div>
            </div>
          </div>
        </div>

        <div class="cmnnt_p pad_t10">
          <p>
            I recently completed another course from the 365 team "Data Science
            Boot Camp" where I was able to review my college course work taken
            many years ago in statistics along with an overview of programming
            languages (Python) I use regularly.
          </p>
          <p class="post_reply mar_t5">Reply</p>
        </div>
      </div>
      <!-- comment -->

      <!-- comment -->

      <!-- iteam -->
      <div class="cmnt_box_all reply_sec">
        <div class="cmnt_box_top dis_flx">
          <div class="cmnt_box_top_left d-flex">
            <div class="cmnt_img mar_r15">
              <img src="img/girl2-cmnt.jpg" alt="image" />
            </div>
            <div class="cmnnt_name">
              <div class="cmnt_name_left">
                <h4 class="tchr_nam mar_b10">Jofra Archer</h4>
              </div>
              <div class="cmnt_name_right">
                <p class="cmnt_name_right_p">11 Dec 2019 AT 07:45 AM</p>
              </div>
            </div>
          </div>
        </div>

        <div class="cmnnt_p pad_t10">
          <p>
            I am on 50% of the course. So far I am very happy about the course.
            very succinct, practical and straight to the point. I am looking
            forward to complete this course so I can move onto data science
          </p>
          <p class="post_reply mar_t5">Reply</p>
        </div>
      </div>
      <!-- iteam -->
    </div>
  </div>
</template>

<script>

export default({
    data() {
        return {
            comments :[]
        }

    },
    async created(){
        const res = await this.callApi('get' , 'https://jsonplaceholder.typicode.com/posts/1')
        if(res.status == 200){
            console.log(res.data)
        }
    }
})
</script>

