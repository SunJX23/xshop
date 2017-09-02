<template>
  <div class="login">
    <el-form ref="login_form" :model="login_form" :rules="rules" class="login-form">
      <el-form-item class="login_form_item_1">
        <h1 class="login_title">{{ title }}</h1>
        <div class="login_tosignin" @click="changeSign(true)"  v-show="!is_login">>> Sign in</div>
      </el-form-item>
      <el-form-item prop="id">
        <el-input v-model="login_form.id" placeholder="用户名"></el-input>
      </el-form-item>
      <el-form-item prop="nick" v-show="!is_login">
        <el-input v-model="login_form.nick" placeholder="昵称"></el-input>
      </el-form-item>
      <el-form-item prop="pasw">
        <el-input v-model="login_form.pasw" placeholder="密码" type="password"></el-input>
      </el-form-item>
      <el-form-item prop="pasw_again" v-show="!is_login">
        <el-input v-model="login_form.pasw_again" placeholder="确认密码" type="password"></el-input>
      </el-form-item>
      <el-form-item prop="verify" v-show="has_verify">
        <el-input v-model="login_form.verify" placeholder="验证码" style="float:left;"></el-input>
        <img class="verify" ></img>
      </el-form-item>
      <el-form-item v-show="is_login">
        <el-checkbox v-model="is_remember">记住密码</el-checkbox>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" v-loading="loading" @click="submit()" class="login-button">{{ title }}</el-button>
      </el-form-item>
      <el-form-item v-show="is_login">
        <div @click="changeSign(false)" class="login_tosignup">还没有账号？快来注册吧！</div>
      </el-form-item>
    </el-form>
  </div>
</template>
<script>
import * as utils from '../../utils'
import http from '../../Network'

const LoginForm = {
  id: null,
  nick: null,
  pasw: null,
  pasw_again: null,
  verify: null
}

const Rules = {
  id: [
    { required: true, message: '请输入用户名', trigger: 'blur' },
    // { min: 3, max: 10, message: '长度在 3 到 10 个字', trigger: 'change' },
    { message: '用户名由3到10个英文/数字/下划线组成', trigger: 'change', validator: utils.validName1 },
    { message: '用户名不可用数字开头', trigger: 'change', validator: utils.validName2 }
  ],
  pasw: [
    { required: true, message: '请输入密码', trigger: 'blur' },
    { min: 6, max: 30, message: '长度在 6 到 30 个字符', trigger: 'change' },
    { message: '密码只能由英文/数字/下划线组成', trigger: 'change', validator: utils.validName3 }
  ],
  pasw_again: [
    { required: true, message: '请再次输入密码确认', trigger: 'blur' },
    { min: 6, max: 30, message: '长度在 6 到 30 个字符', trigger: 'change' },
    { message: '密码只能由英文/数字/下划线组成', trigger: 'change', validator: utils.validName3 }
  ],
  nick: [
    { required: true, message: '请输入昵称', trigger: 'blur' },
    { min: 2, max: 13, message: '长度在 2 到 13 个字', trigger: 'change' },
    { message: '昵称只能有中文/英文/下划线/数组组成', trigger: 'change', validator: utils.validName4 }
  ]
}

export default {
  data() {
    return {
      login_form: { ...LoginForm },
      rules: { ...Rules },
      loading: false,
      is_remember: false,
      is_login: true,
      has_verify: false,
      title: 'Sign in',
      checkPsw: (rule, value, callback) => {
        if (!value || !this.login_form.pasw || !this.login_form.pasw_again) callback()
        let test = this.login_form.pasw === this.login_form.pasw_again;
        test ? callback() : callback(new Error('两次密码输入不一致'));
        return test;
      },
      checkID: (rule, value, callback) => {
        if (!value) callback();
        let test = true
        this.$http.post(this.BACK_DOMAIN+'checkUId',{user_id: value}).then((res) => {
          console.log(res.data);
          this.is_remember = (res.data && res.data.ret === 1) || res.status !== 200;
        }).catch(function(err){
          console.log('Error', err);
        })
        console.log(this.is_remember)
        test ? callback() : callback(new Errror('用户名已存在'));
        return test
      },
      checkVerify: (rule, value, callback) => {
        if (!value) callback();
        let test = true;
        test ? callback() : callback(new Errror('验证码错误'));
        return test;
      }
    }
  },
  methods: {
    submit: function () {
      console.log('form', this.login_form);
    },
    resetData: function () {
      this.login_form = { ...LoginForm };
      this.loading = false;
      this.is_remember = false;
      this.is_login = true;
      this.has_verify = false;
      this.title = 'Sign in';
      this.$refs.login_form.resetFields();
    },
    changeSign: function (is_login) {
      this.resetData();
      this.init(is_login);
    },
    refreshVerify: function () {
      return true;
    },
    addRules: function () {
      this.rules.id.push({ message: '用户名已存在', trigger: 'blur', validator: this.checkID });
      this.rules.pasw.push({ message: '两次密码输入不一致', trigger: 'change', validator: this.checkPsw });
      this.rules.pasw_again.push({ message: '两次密码输入不一致', trigger: 'change', validator: this.checkPsw });
      this.rules.verify = [{ message: '验证码错误', trigger: 'blur', validator: this.checkVerify }];
    },
    init: function (islogin) {
      this.is_login = islogin === undefined ? (this.$route.query.sign && this.$route.query.sign === 'up' ? false : true) : islogin;
      this.title = this.is_login ? 'Sign in' : 'Sign up';
      this.has_verify = this.refreshVerify();
      this.addRules();
    }
  },
  created: function () {
    this.init();
  },
  beforeDestory: function () {
    console.log('beforeDestory');
    this.resetData();
  },
  watch: {
  }
}
</script>
