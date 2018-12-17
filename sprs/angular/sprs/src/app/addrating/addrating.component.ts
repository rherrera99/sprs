import { Component, OnInit ,ElementRef,ViewChild} from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { AngularHttpProvider } from '../angular-http';
import { Router } from "@angular/router";
import * as $ from 'jquery';
import { element } from 'protractor';
import { NgbDatepickerDayView } from '@ng-bootstrap/ng-bootstrap/datepicker/datepicker.module';
import {formatDate} from '@angular/common';





@Component({
  selector: 'app-addrating',
  templateUrl: './addrating.component.html',
  styleUrls: ['./addrating.component.css'],
  //host: { '(document:click)': 'hostClick($event)' },
})
export class AddratingComponent implements OnInit {

//   @ViewChild('d') d: any;

//   @ViewChild('startContainer') startContainer: ElementRef;
    
//   hostClick(event) {
//     let startIsOpen: boolean = this.d.isOpen();   
//     if (startIsOpen) {
//         if (this.startContainer && this.startContainer.nativeElement && !this.startContainer.nativeElement.contains(event.target)) {                
//             console.log("Not in startDate container - closing.");
//             this.d.close();
//         }
//     }
// }

  public loading = false;
  FileSaveId: any;
  time1 = { hour: new Date().getHours(), minute: new Date().getMinutes() };
  meridian = false;
  useCurrent = true;
  now = new Date();
  selectedFile :File;

  modelTime = formatDate(new Date(), 'yyyy-MM-dd', 'en');
  
  



  addRatingForm: any;
  theHtmlString: string
  theError: any;
  server_response: string;
  formList: Array<any> = [];
  model: any = {};
  field_list: Array<any> = [];
  images_array :Array<any> = [];

  constructor(private formBuilder: FormBuilder, private router: Router, private angularHttp: AngularHttpProvider) {
    this.theError = "";
    this.FileSaveId = ''
    
    // this.addRatingForm = this.formBuilder.group({
    //   // 'txt_date': ['', Validators.required],
    //   // 'txt_timeto': ['', [Validators.required]],
    //   // 'txt_timefrom': ['', [Validators.required]],
    //   // 'txt_weight': ['', [Validators.required]],
    //   // 'txt_height': ['', [Validators.required]],
    //   // 'txt_sugar': ['', [Validators.required]],
    //   // 'txt_bloodpresure': ['', [Validators.required]],
    //   //'profile': ['', [Validators.required, Validators.minLength(10)]]
    // });
  }

  onClickSubmit(data) {
    console.log(data);
    this.theError = [];
    let selected_form = this.field_list[data.form_id];
    let final_json = [];
    let form_id = data.form_id;
    let form_allcated_id = data.form_allcated_id;

    selected_form.forEach(form_details => {
      let localArray = [];
      let field_id = form_details["field_id"];
      let field_name = data["field_id_" + form_details["field_id"]];
      let options = 0;
      let value;
      let setdate;
      let settime;
      let units = "";



      if (form_details["options"].length > 0 && form_details["field_type"] != '6' && form_details["field_type"] != '4') {
        options = 1;
        let option_arr = [];
        //let option_details=form_details["options"]
        // console.log(form_details["field_type"] + " here 2");
        let selected_values = [];
        form_details["options"].forEach(options_dtls => {
          // console.log(data["field_value_" + form_details["field_id"] + "_" + options_dtls]);

          // if( data["is_required_" + form_details["field_id"]]=='1'){
          //  alert('iffff');
          // }
          if (form_details["field_type"] != '5') {
            if (data["field_value_" + form_details["field_id"] + "_" + options_dtls] != undefined) {

              selected_values.push({ "option_id": options_dtls, "value": data["field_value_" + form_details["field_id"] + "_" + options_dtls] });
            }
          } else {
            if (data["field_value_" + form_details["field_id"] + "_" + options_dtls] == true) {
              selected_values.push({ "option_id": options_dtls, "value": data["option_value_" + form_details["field_id"] + "_" + options_dtls] });
            }
          }
        });
       value = selected_values;
        if (data["is_required_" + form_details["field_id"]] == '1' && (value == '' || value.length == 0)) {

          this.theError.push(data["field_id_" + form_details["field_id"]] + " required");
          //  this.theError += '  '+data["field_id_" + form_details["field_id"]]+" is required"+"</br>";
        }
      } else {



        if (form_details["field_type"] == '7') {

          // setdate = data["field_value_" + form_details["field_id"]];
          // let day;
          // if (setdate.day <= 9) {

          //   day = '0' + setdate.day;

          // }
          // else {
          //   day = setdate.day;
          // }
          // let mon;
          // if (setdate.month <= 9) {
          //   mon = '0' + setdate.month;
          // } else {
          //   mon = setdate.month;
          // }

          //value = setdate.year + '-' + mon + '-' + day;
          value = data["field_value_" + form_details["field_id"]];
          options = 0;

        } else if (form_details["field_type"] == '8') {

          settime = data["field_value_" + form_details["field_id"]];

          let dayhou;
          if (settime.hour <= 9) {

            dayhou = '0' + settime.hour;

          }
          else {
            dayhou = settime.hour;
          }
          let monu;
          if (settime.minute <= 9) {
            monu = '0' + settime.minute;
          } else {
            monu = settime.minute;
          }


          value = dayhou + ':' + monu;

          options = 0;

        } else if (form_details["field_type"] == '9') {
          
          value="";
          if(this.images_array[form_details["field_id"]] != undefined){
            value = this.images_array[form_details["field_id"]];
          }
         
          

        } else {
          // console.log(form_details["field_type"] + " here");
          // console.log(data["field_value_" + form_details["field_id"]]);
          // console.log(data["field_value_" + form_details["field_id"]]);
          value = data["field_value_" + form_details["field_id"]];
          //console.log(value.day);
          options = 0;
        }

        if (data["is_required_" + form_details["field_id"]] == '1' && (value == '' || value == "0")) {

          this.theError.push(data["field_id_" + form_details["field_id"]] + " required");
          // this.theError += '  '+data["field_id_" + form_details["field_id"]]+" is required"+"</br>";
        }

      }
      if (data["field_units_" + form_details["field_id"]] != undefined && data["is_required_" + form_details["field_id"]] == '1' && data["field_units_" + form_details["field_id"]] != '0') {
        units = data["field_units_" + form_details["field_id"]];
      }
      else if (data["field_units_" + form_details["field_id"]] != undefined && data["is_required_" + form_details["field_id"]] == '1' && data["field_units_" + form_details["field_id"]] == '0') {
        this.theError.push(data["field_id_" + form_details["field_id"]] + " unit required");
      }
      final_json.push({ "field_id": field_id, "field_type": parseInt(form_details["field_type"]), "field_name": field_name, "options": options, "value": value, "is_dashboard": parseInt(data["is_dashboard_" + form_details["field_id"]]), "is_table": parseInt(data["is_table_" + form_details["field_id"]]), "units": units });
    });
    // console.log(JSON.stringify(selected_form));
    //console.log(JSON.stringify(data));
    console.log(this.theError);
    console.log(data);
    var ptformData = {
      user_id: localStorage.getItem('user_id'),
      form_id: form_id,
      form_allcated_id: form_allcated_id,
      form_data: final_json


    };

    if (this.theError.length == 0) {
      this.angularHttp.post("addptReading.json", ptformData)
        .toPromise()
        .then((response) => {
          this.server_response = JSON.stringify(response.json());
          console.log(this.server_response);
          var data = JSON.parse(this.server_response);

          if (data.status == 200) {
            this.router.navigateByUrl('readings/list');
          } else {
            this.theHtmlString = data.message;

          }


        })
        .catch((error) => {
          this.server_response = error._body;
        });
    }

  }

  onFileChanged(event,id) {
    //alert(id);
      //  / this.selectedFile = event.target.files[0];
       

        if (event.target.files && event.target.files[0]) {
          var reader = new FileReader();
    
          reader.readAsDataURL(event.target.files[0]); // read file as data url
    
          reader.onload = (e) => { // called once readAsDataURL is completed
            let target = <any> e.target ;
            let image = target.result;
            this.selectedFile =image;
            this.images_array[id]=this.selectedFile;
           // return this.selectedFile;
            //this.onUpload();
            console.log(this.selectedFile);
          }
        }
      }

  ngOnInit() {


    this.getAssignedForms();
    // this.uploader.onAfterAddingFile = (file) => { file.withCredentials = false; };
    // this.uploader.onCompleteItem = (item: any, response: any, status: any, headers: any) => {
    //   //console.log('ImageUpload:uploaded:', item, status, response);
    //   //alert('File uploaded successfully');
    //   this.loading = false;
    //   // this.router.navigateByUrl('/profile');;
    // };

  }


  getAssignedForms() {

    this.loading = true;
    var sendData = { 'user_id': localStorage.getItem('user_id') }
    this.angularHttp.post("get-user-add-form.json", sendData)
      .toPromise()
      .then((response) => {
        this.server_response = JSON.stringify(response.json());
        var data = JSON.parse(this.server_response);

        if (data.status == 200) {
          console.log(data.data['formlist']);
          this.formList = data.data['formlist'];
          this.formList.forEach(forms => {
            let form_field_list = [];
            //console.log(forms);
            let form_details = forms["formdetails"];
            form_details.forEach(fields => {

              let form_options_array = [];
              if (fields["formoptions"]) {
                fields["formoptions"].forEach(options => {
                  form_options_array.push(options["id"]);
                });
              } else {

              }
              form_field_list.push({ 'field_id': fields.id, 'field_type': fields.field_type, 'options': form_options_array });
              
            });
            this.field_list[forms["id"]] = form_field_list;
          });
          //console.log(this.formList);
          this.loading = false;
        }


      })
      .catch((error) => {
        this.server_response = error._body;
        this.loading = false;
      });

  }

}
