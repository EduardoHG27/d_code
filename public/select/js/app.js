
var app = new Vue({
  el: '#app',
  data: {
    scanner: null,
    activeCameraId: null,
    cameras: [],
    scans: []
  },
  mounted: function () {
    var self = this;
    self.scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5 });
    self.scanner.addListener('scan', function (content, image) {
      self.scans.unshift({ date: +(Date.now()), content: content });
      
      $.ajax({
       // url:'http://192.168.100.158:8080/gym_code/public/student/qr',
       url:'http://gym-system.ecommerce343.com/gym_code/public/student/qr',
        method: "post",
        data: {
          id: content
      },
        success: function(resp) {
          var result = $.parseJSON(resp);
          console.log(result.data);

          if(result.resp=='0')
          {
            Swal.fire(
              'Atencion!',
              result.data,
              'warning'
            )
          }else
          {
            Swal.fire(
              'Bienvenido',
              result.data[0]['name'],
              'success'
            )
          }
          
        }
    });
      
    });
    Instascan.Camera.getCameras().then(function (cameras) {
      self.cameras = cameras;
      if (cameras.length > 0) {
        self.activeCameraId = cameras[0].id;
        self.scanner.start(cameras[0]);
      } else {
        console.error('No cameras found.');
      }
    }).catch(function (e) {
      console.error(e);
    });
  },
  methods: {
    formatName: function (name) {
      return name || '(unknown)';
    },
    selectCamera: function (camera) {
      this.activeCameraId = camera.id;
      this.scanner.start(camera);
    }
  }
});
