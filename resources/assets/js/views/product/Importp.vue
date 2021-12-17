<template>
  <div class="container-fluid">
    <Breadcrumb>
      <BreadcrumbItem to="/dashboard" replace>หน้าหลัก</BreadcrumbItem>
      <BreadcrumbItem to="/product/list">ผลิตภัณฑ์</BreadcrumbItem>
      <BreadcrumbItem>บันทึกการนำเข้าผลิตภัณฑ์</BreadcrumbItem>
    </Breadcrumb>
    <br>

    <Form ref="formimportp" :model="formimportp" :rules="ruleCustom">
      <Row type="flex" justify="space-around" align="middle">
        <Col span="15">
        <div class="Createfrom1-p">
          <Row>
            <Col span="24">
            <div class="title-from1">
              เพิ่มผลิตภัณฑ์ เข้าระบบครังแรก
            </div>
            </Col>
            <Col span="24" class="sub-title1">
            ช่องที่มี <span style="color: rgb(255, 0, 0);">*</span> เป็นช่องที่จำเป็นต้องกรอก
            </Col>

          </Row>
          <br>
          <Row type="flex" justify="space-between">
            <Col span="10" class="left-Formitem">
            <FormItem prop="Batch_no" :label-width="133">
              <span slot="label" style="width: 10%;">เลขที่ครังที่ผลิต:</span>
              <Input type="text" v-model="formimportp.Batch_no" placeholder="" size="small" />

            </FormItem>
            </Col>
            <Col span="10" class="right-Formitem">
            <FormItem prop="name_p">
              <span slot="label" style="width: 10%;">รายการ:</span>
              <Select v-model="formimportp.name_p" placeholder="ค้นหา วัตถุดิบ" style="width: 50%;" size="small">
                <Option v-for="item in formimportp.name_p" :value="item.value" :key="item.value">{{ item.label }}</Option>
              </Select>

            </FormItem>
            </Col>
          </Row>
          <Row type="flex" justify="space-between">
            <Col span="12" class="left-Formitem">
            <FormItem prop="import_at" :label-width="133">
              <span slot="label" style="word-wrap: break-word;">ว-ด-ป นำเข้า:</span>
              <DatePicker v-model="formimportp.import_at" size="small" type="date" placeholder="Select date" style="width: 90%;" />
            </FormItem>
            </Col>
            <Col span="10" class="right-Formitem">
            <FormItem prop="qty_charge">
              <span slot="label" style="width: 10%;">จำนวน:</span>
              <InputNumber size="small" v-model="formimportp.qty_charge" :formatter="value => `${value}`.replace(/\B(?=(?!\d))/g, '.')" :parser="value => value.replace(/\$\s?|(,*)/g, '')" controls-outside />
            </FormItem>
            </Col>
          </Row>
          <Row type="flex" justify="space-between">
            <Col span="10" class="left-Formitem">
            <FormItem prop="storage" :label-width="133">
              <span slot="label">สถานที่จัดเก็บ</span>
              <Select v-model="formimportp.storage" placeholder="ค้นหา ผู้ผลิต/ผู้จัดจำหน่าย" size="small">
                <Option v-for="item in formimportp.storage" :value="item.value" :key="item.value">{{ item.label }}</Option>
              </Select>

            </FormItem>
            </Col>
            <Col span="13" class="right-Formitem">
            <FormItem prop="PID">
              <span slot="label" style="width: 10%;">ผู้ส่ง:</span>
              <Select v-model="formimportp.PID" placeholder="ค้นหา ผู้ส่ง" style="width: 45%;" size="small">
                <Option v-for="item in formimportp.PID" :value="item.value" :key="item.value">{{ item.label }}</Option>
              </Select>

            </FormItem>
            </Col>
          </Row>

          <Row type="flex" justify="space-around">
            <Col span="11" class="left-Formitem">
            <FormItem prop="MFG" :label-width="133">
              <span slot="label" style="width: 10%;word-wrap: break-word;">ว-ด-ป ที่ผลิต (FG.):</span>
              <DatePicker v-model="formimportp.MFG" size="small" type="date" placeholder="Select date" style="width: 90%;" />

            </FormItem>
            </Col>
            <Col span="11" class="right-Formitem">
            <FormItem prop="EXP" :label-width="133">
              <span slot="label" style="width: 10px;word-wrap: break-word;">ว-ด-ป หมดอายุ (EXP.):</span>
              <DatePicker v-model="formimportp.EXP" size="small" type="date" placeholder="Select date" style="width: 90%;" />
            </FormItem>
            </Col>

          </Row>
          <Row type="flex" justify="center">
            <Col span="12">

            </Col>
          </Row>
        </div>
        </Col>

        <Col span="7">
        <div class="Createfrom2-p">
          <br>
          <Row type="flex" justify="center">
            <Col span="24">
            <div style="background-color: rgb(255, 255, 255);">
              <div class="demo-upload-list">
                <template>
                  <img :src="defaultList.url">
                  <div class="demo-upload-list-cover">
                    <Icon type="ios-eye-outline" @click.native="handleView(item.name)"></Icon>
                    <Icon type="ios-trash-outline" @click.native="handleRemove(item)"></Icon>
                  </div>
                </template>

              </div>
              <Divider />
              <Upload ref="upload" :show-upload-list="false" :default-file-list="defaultList" :on-success="handleSuccess" :format="['jpg','jpeg','png']" :max-size="2048" :on-format-error="handleFormatError" :on-exceeded-size="handleMaxSize" :before-upload="handleBeforeUpload" type="drag" action="//jsonplaceholder.typicode.com/posts/" style="margin: 5px;">
                <div style="padding: 10px 0; ">
                  <span>กด เพื่ออัปเดตรูปภาพ</span>
                </div>

              </Upload>

            </div>
            </Col>
          </Row>
          <br>
          <Row type="flex" justify="center">
            <Col span="24">
            <div class="input-role">
              <h5 style="display: inline-block;">รายละเอียดย่อย</h5>
              <Input v-model="formimportp.desc" :autosize="{minRows: 2,maxRows: 5}" type="textarea" size="small" style="width: auto; display: inline-block;" />
            </div>
            </Col>
          </Row>
          <br>
          <Row type="flex" justify="center">
            <Col span="24">
            <div class="input-role">
              <h5 style="display: inline-block;">ผู้ตรวจรับ</h5>
              <Input v-model="formimportp.UID" readonly type="text" size="small" style="width: auto; display: inline-block;" />
            </div>
            </Col>
          </Row>
          <br>
          <Row type="flex" justify="center">
            <Col span="24">
            <FormItem>
              <Row type="flex" justify="center">
                <Button type="primary" @click="handleSubmit('formimportp')">Submit</Button>
                <Button @click="handleReset('formimportp')" style="margin-left: 8px">Reset</Button>
              </Row>
            </FormItem>
            </Col>
          </Row>
        </div>
        </Col>
      </Row>
      <br>
    </Form>

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
      formimportp: {
        Batch_no: "",
        UID: "test",
        name_p: "",
        import_at: "",
        EXP: "",
        MFG: "",
        qty_charge: 1,
        invoice_no: "",
        desc: "--",
        LOT_no: "",
        PID: [],
        storage_ID: [],
      },

      ruleCustom: {
        Batch_no: [
          {
            required: true,
            message: "กรุณากรอกด้วย !!",
            trigger: "blur",
          },
        ],
        name_p: [
          {
            required: true,
            message: "กรุณากรอกด้วย !!",
            trigger: "blur",
          },
        ],
        invoice_no: [
          {
            required: false,
            message: "กรุณากรอกด้วย !!",
            trigger: "blur",
          },
        ],
        LOT_no: [
          {
            required: true,
            message: "กรุณากรอกด้วย !!",
            trigger: "blur",
          },
        ],
        qty_charge: [
          {
            required: true,
            message: "กรุณากรอกด้วย !!",
            trigger: "change",
            type: "number",
          },
        ],
        MFG: [
          {
            required: true,
            type: "date",
            message: "Please select the date1",
            trigger: "change",
          },
        ],
        EXP: [
          {
            required: true,
            type: "date",
            message: "Please select the date2",
            trigger: "change",
          },
        ],
        import_at: [
          {
            required: true,
            type: "date",
            message: "Please select the date3",
            trigger: "change",
          },
        ],
        PID: [
          {
            required: true,
            message: "Please select the city",
            trigger: "change",
          },
        ],
        storage_ID: [
          {
            required: true,
            message: "Please select the storage_ID",
            trigger: "change",
          },
        ],
        desc: [
          {
            required: false,
            message: "Please enter a personal introduction",
            trigger: "blur",
          },
          {
            type: "string",
            min: 20,
            message: "Introduce no less than 20 words",
            trigger: "blur",
          },
        ],
      },
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
      file.url = "";
      file.name = "";
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
    handleSubmit(name) {
      this.$refs[name].validate((valid) => {
        if (valid) {
          this.$Message.success("Success!");
        } else {
          this.$Message.error("Fail!");
        }
      });
    },
    handleReset(name) {
      this.$refs[name].resetFields();
    },
  },
  mounted() {
    this.uploadList = this.$refs.upload.fileList;
  },
};
</script>


<style>
.Createfrom1-p {
  background-color: rgb(255, 255, 255);
  height: 400px;
}

.title-from1 {
  margin: 20px 0 0 40px;
  font-size: 15px;
  font-weight: bold;
  color: #000;
  text-shadow: 8px 4px 6px #959595a8;
}
.sub-title1 {
  margin-left: 50px;
  font-size: 10px;
}
.left-Formitem {
  padding-left: 30px;
}
.right-Formitem {
  padding-right: 30px;
}
.Createfrom2-p {
  background-color: rgb(255, 255, 255);
  height: 500px;
}

.ivu-form-item-error-tip {
  font-size: 10px;
}
.ivu-form-item {
  margin-bottom: 10px;
}

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
</style>