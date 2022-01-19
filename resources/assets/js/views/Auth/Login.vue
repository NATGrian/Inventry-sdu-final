<template>

  <div class="container-fluid" id="Login-container">
    <Row type="flex" justify="center" align="middle" class="formlogin">
      <Col span="9">
      <Form id="form-login" ref="form" :model="form" :rules="ruleInline">
        <Row type="flex" justify="start" align="middle">
            <Col><Icon type="md-log-in" size="34" style="color: #000;"/> </Col>
            <Col><h1> เข้าสู่ระบบ</h1></Col>
        </Row>
        <Row type="flex" justify="space-around" align="top">
          <Col span="16">
          <FormItem prop="email">
            <Input element-id="login-email" type="email" prefix="ios-mail" size="large" v-model="form.email" placeholder="email" @on-enter="login">
            </Input>
          </FormItem>
          <FormItem prop="password">
            <Input element-id="login-password" type="password" prefix="ios-lock" size="large" v-model="form.password" placeholder="Password" @on-enter="login">
            </Input>
          </FormItem>
          </Col>

          <Col span="5">
          <Button type="primary" @click="login" :loading="isProcessing" style="height: 105px;background-color: #000;border-color: #fff;">
            <span v-if="!isProcessing">
              <Icon type="md-lock" size="27" />
            </span>
            <span v-else>
             
            </span>
          </Button>

          </Col>
        </Row>

      </Form>
      </Col>
    </Row>
  </div>

</template>
<script type="text/javascript">
import Flash from "../../helpers/flash";
import Auth from "../../store/auth";
import { post } from "../../helpers/api";
export default {
  data() {
    return {
      form: {
        email: "",
        password: "",
      },
      error: {},
      isProcessing: false,
      ruleInline: {
        email: [
          {
            required: true,
            message: "ใส่อีเมลให้ถูกต้อง",
            trigger: "blur",
          },
        ],
        password: [
          {
            required: true,
            message: "กรอกรหัสผ่าน",
            trigger: "blur",
          }
        ],
      },
    };
  },
  methods: {
    login() {
      this.isProcessing = true;
        this.error = {}
      post("api-inv/login", this.form)
        .then((res) => {
          if (res.data.authenticated) {
            // set token
            Auth.set(
              res.data.api_token,
              res.data.user_id,
              res.data.authenticated
            );
            this.$Message.success('เข้าสู่ระบบสำเร็จ!');
            this.$Loading.finish();
            // this.$router.push('/dashboard')
            window.location.href = "/dashboard";
          }
          this.isProcessing = false;
        })
        .catch((err) => {
          if (err.response.status === 422) {
            this.error = err.response.data;
            this.$Message.error('กรอกอีเมลหรือรหัสผ่านไม่ถูกต้อง');
          }
          this.isProcessing = false;
        });
    },
  },
};
</script>
<style>
.formlogin {
  height: 400px;
}
</style>