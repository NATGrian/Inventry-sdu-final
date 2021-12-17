<template>
  <div class="container-fluid">
    <Breadcrumb>
      <BreadcrumbItem to="/dashboard" replace>หน้าหลัก</BreadcrumbItem>
      <BreadcrumbItem >ข้อมูลส่วนตัว</BreadcrumbItem>
    </Breadcrumb>
    <br>

    <Row>
      <Col flex="1 150px" style=" margin: 2px; border: 1px ridge #dbdbdb; padding: 3px; ">

      <div style="background-color: rgb(255, 255, 255);">
        <div class="demo-upload-list" v-for="item in uploadList" :key="item">
          <template v-if="item.status === 'finished'">
            <img :src="item.url">
            <div class="demo-upload-list-cover">
              <Icon type="ios-eye-outline" @click.native="handleView(item.name)"></Icon>
              <Icon type="ios-trash-outline" @click.native="handleRemove(item)"></Icon>
            </div>
          </template>
          <template v-else>
            <Progress v-if="item.showProgress" :percent="item.percentage" hide-info></Progress>
          </template>
        </div>
        <Divider />
        <Upload ref="upload" :show-upload-list="false" :default-file-list="defaultList" :on-success="handleSuccess" :format="['jpg','jpeg','png']" :max-size="2048" :on-format-error="handleFormatError" :on-exceeded-size="handleMaxSize" :before-upload="handleBeforeUpload" type="drag" action="//jsonplaceholder.typicode.com/posts/" style="margin: 5px;">
          <div style="padding: 10px 0; ">
            <span>กด เพื่ออัปเดตรูปภาพ</span>
          </div>

        </Upload>
        <br>
        <div class="input-role">
          <h5 style="display: inline-block;">ตำแหน่ง</h5>
          <Input v-model="value9" readonly type="text" size="small" style="width: auto; display: inline-block;" />
        </div>
        <br>
      </div>

      </Col>

      <Col flex="4 200px" style=" margin: 2px; ">
      <Header class="Header-c">
       <span style="font-weight: bold;">profile information</span> <Divider type="vertical" style="background-color: rgb(119, 119, 119);"/> <span>ข้อมูลส่วนตัว</span>
       <Button type="success" shape="circle" label="small" icon="md-checkmark" style="position: absolute; right: 3px; top:8px;height: 25px;">save</Button>
      </Header>
      <br>
      <Content class="Content-profile">
        <Row type="flex" justify="space-around">
            <Col :md="8" :sm="12" class="profile-input">
            <span style="width: 100%;">ชื่อจริง</span>
            <Input prefix="ios-contact"  style="width: auto" />
            </Col>
            <br>
            <Col :md="8" :sm="12" class="profile-input">
            <span style="width: 100%;">นามสกุล</span>
            <Input prefix="ios-contact"  style="width: auto" />
            </Col>
        </Row>
        <br>
        <Row type="flex" justify="space-around">
            <Col :md="8" :sm="12" class="profile-input">
            <span style="width: 100%;">Email</span>
            <Input prefix="ios-mail"  style="width: auto" />
            </Col>
            <br>
            <Col :md="8" :sm="12" class="profile-input">
            <span style="width: 100%;">เบอร์ติดต่อ</span>
            <Input prefix="md-closed-captioning"  style="width: auto" />
            </Col>
        </Row>
        <br>
        <Row type="flex" justify="space-around">
            <Col :md="8" :sm="12" class="profile-input">
            <span style="width: 100%;">รหัสผ่านไหม่</span>
            <Input prefix="ios-lock"  style="width: auto" type="password" password/>
            </Col>
            <br>
            <Col :md="8" :sm="12" class="profile-input">
            <span style="width: 100%;">ยืนยันรหัสผ่าน</span>
            <Input prefix="ios-lock"  style="width: auto" type="password" password/>
            </Col>
        </Row>
        <br>
        <Row type="flex" justify="center">
            <Col :md="8" :sm="12" class="profile-input">
            <span style="width: 100%;">รหัสผ่านปัจจุบัน</span>
            <Input prefix="ios-unlock"  style="width: auto" type="password" password/>
            </Col>
        </Row>
      </Content>
      </Col>
    </Row>

  </div>
</template>



<script>
export default {
  data() {
    return {
      defaultList: [
        {
          name: "a42bdcc1178e62b4694c830f028db5c0",
          url: "https://scontent.fbkk28-1.fna.fbcdn.net/v/t1.6435-9/p180x540/254085434_2709976465978344_5093268077704129993_n.jpg?_nc_cat=100&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=QsqbCcSREhMAX-FH-Wa&tn=ZRHz0vOh5V0LaJlp&_nc_ht=scontent.fbkk28-1.fna&oh=3a7a1affff2278e907577002ac31396a&oe=61B0B0D2",
        },
      ],
      imgName: "",
      visible: false,
      uploadList: [],
      value9: "5555",
    };
  },
  methods: {
    handleView(name) {
      this.imgName = name;
      this.visible = true;
    },
    handleRemove(file) {
      const fileList = this.$refs.upload.fileList;
      this.$refs.upload.fileList.splice(fileList.indexOf(file), 1);
    },
    handleSuccess(res, file) {
      file.url =
        "https://scontent.fbkk28-1.fna.fbcdn.net/v/t1.6435-9/p180x540/254085434_2709976465978344_5093268077704129993_n.jpg?_nc_cat=100&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=QsqbCcSREhMAX-FH-Wa&tn=ZRHz0vOh5V0LaJlp&_nc_ht=scontent.fbkk28-1.fna&oh=3a7a1affff2278e907577002ac31396a&oe=61B0B0D2";
      file.name = "7eb99afb9d5f317c912f08b5212fd69a";
    },
    handleFormatError(file) {
      this.$Notice.warning({
        title: "The file format is incorrect",
        desc:
          "File format of " +
          file.name +
          " is incorrect, please select jpg or png.",
      });
    },
    handleMaxSize(file) {
      this.$Notice.warning({
        title: "Exceeding file size limit",
        desc: "File  " + file.name + " is too large, no more than 2M.",
      });
    },
    handleBeforeUpload() {
      const check = this.uploadList.length < 5;
      if (!check) {
        this.$Notice.warning({
          title: "Up to five pictures can be uploaded.",
        });
      }
      return check;
    },
  },
  mounted() {
    this.uploadList = this.$refs.upload.fileList;
  },
};
</script>



<style>
.demo-upload-list {
  left: 50%;
  transform: translateX(-50%);
  width: 120px;
  height: 120px;
  text-align: center;
  line-height: 60px;
  border: 1px solid transparent;
  border-radius: 4px;
  overflow: hidden;
  background: #fff;
  position: relative;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
  margin-top: 3px;
}
.demo-upload-list img {
  width: 100%;
  height: 100%;
}
.demo-upload-list-cover {
  display: none;
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.6);
}
.demo-upload-list:hover .demo-upload-list-cover {
  display: block;
}
.demo-upload-list-cover i {
  color: #fff;
  font-size: 20px;
  cursor: pointer;
  margin: 0 2px;
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
 padding: 0 30px ;
 border-radius: 12px 12px 12px 12px;
 border: 1px double #d3d3d3;
}

.Content-profile {
 min-Height: '400px';
 border: 1px double #d3d3d3;
 background: rgb(255, 255, 255);
 padding: 30px 10px 10px 10px;
}
.profile-input {
 border: 1px ridge #b7b7b7;
 padding: 5px;
}
</style>
