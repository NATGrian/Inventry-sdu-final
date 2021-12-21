<template>
  <div class="container-fluid">
    <Breadcrumb>
      <BreadcrumbItem to="/dashboard" replace>หน้าหลัก</BreadcrumbItem>
      <BreadcrumbItem>ข้อมูลส่วนตัว</BreadcrumbItem>
    </Breadcrumb>
    <br>

    <Row type="flex" justify="center" align="middle">

      <Col span="18" style=" margin: 2px; ">
      <Header class="Header-c">
        <span style="font-weight: bold;">profile information</span>
        <Divider type="vertical" style="background-color: rgb(119, 119, 119);" /> <span>ข้อมูลส่วนตัว</span>
        <Button @click="save" type="success" shape="circle" label="small" icon="md-checkmark" style="position: absolute; right: 3px; top:8px;height: 25px;">save</Button>
      </Header>
      <br>
      <Content class="Content-profile">
        <Form ref="formedit" :model="formedit" label-position="top">
          <Row type="flex" justify="space-around">
            <Col :md="8" :sm="12" class="profile-input">
            <FormItem label="ชื่อจริง">
              <Input prefix="ios-contact" v-model="formedit.firstname" placeholder="Enter your name"></Input>
            </FormItem>
            </Col>
            <br>
            <Col :md="8" :sm="12" class="profile-input">
            <FormItem label="นามสกุล">
              <Input prefix="ios-contact" v-model="formedit.lastname" placeholder="Enter your name"></Input>
            </FormItem>
            </Col>
          </Row>
          <br>
          <Row type="flex" justify="space-around">
            <Col :md="8" :sm="12" class="profile-input">
            
            <FormItem label="เบอร์ติดต่อ">
              <Input prefix="md-closed-captioning" v-model="formedit.phone" placeholder="Enter your name"></Input>
            </FormItem>
            </Col>
            <br>
            <Col :md="8" :sm="12" class="profile-input">
            <FormItem label="Email">
              <Input prefix="ios-mail" type="email" v-model="formedit.email" placeholder="Enter your name"></Input>
            </FormItem>
            </Col>
          </Row>
          <br>
          <Row type="flex" justify="space-around">
            <Col :md="8" :sm="12" class="profile-input">
            <FormItem label="รหัสผ่านไหม่">
              <Input prefix="ios-lock" v-model="formedit.newpassword" type="password" password placeholder="Enter your name"></Input>
            </FormItem>
            </Col>
            <br>
            <Col :md="8" :sm="12" class="profile-input">
            <FormItem label="รหัสผ่านปัจจุบัน">
              <Input prefix="ios-lock" v-model="formedit.passwordold" type="password" password placeholder="Enter your name"></Input>
            </FormItem>
            </Col>
          </Row>
          <br>
          <Row type="flex" justify="center">
            <Col :md="8" :sm="12" class="profile-input">
            <div class="input-role">
              <h5>ตำแหน่ง</h5>
              <Input v-model="formedit.role" readonly type="text" size="small" style="width: auto; display: inline-block;" />
            </div>
            </Col>
          </Row>
        </Form>
      </Content>
      </Col>
    </Row>

  </div>
</template>



<script>
  import { get, put } from '../../helpers/api'
  import Vue from 'vue'
export default {
  
  created() {
			get(this.initializeURL)
				.then((res) => {
					Vue.set(this.$data, 'formedit', res.data.formedit)
				})
		},
  data() {
    return {
      storeURL: `/api-inv/users/${this.$route.params.id}`,
      initializeURL: `/api-inv/users/${this.$route.params.id}/edit`,
      formedit: { 
        newpassword: '',
        passwordold: ''
      },

    };
  },
  methods: {
    save () {
      put(this.storeURL, this.formedit).then((res) => {
        if (res.data.done) {
          this.$Message.info("สำเร็จ");
          this.$forceUpdate();
        }
      });
    },
  },
};
</script>



<style>
.ivu-form-item {
  margin-bottom: 0;
}
.ivu-form-label-top .ivu-form-item-label {
  padding: 0 0 0 0;
}
.ivu-divider-horizontal {
  margin: 10px 0;
}
.input-role {
  display: block;
  text-align: center;
}
.Header-c {
  background: rgb(255, 255, 255);
  height: 40px;
  line-height: 40px;
  padding: 0 30px;
  border-radius: 12px 12px 12px 12px;
  border: 1px double #d3d3d3;
}

.Content-profile {
  min-height: "400px";
  border: 1px double #d3d3d3;
  background: rgb(255, 255, 255);
  padding: 30px 10px 10px 10px;
}
.profile-input {
  border: 1px ridge #b7b7b7;
  padding: 5px;
}
</style>
