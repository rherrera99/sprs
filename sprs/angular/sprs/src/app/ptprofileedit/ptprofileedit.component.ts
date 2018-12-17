import { Component, OnInit,ElementRef,ViewChild } from '@angular/core';
import { AngularHttpProvider } from '../angular-http';
import { User } from '../_models';
import { FormBuilder, Validators } from '@angular/forms';
import { Router } from "@angular/router";
import { FileUploader, FileSelectDirective } from 'ng2-file-upload/ng2-file-upload';






@Component({
  selector: 'app-ptprofileedit',
  templateUrl: './ptprofileedit.component.html',
  styleUrls: ['./ptprofileedit.component.css'],
  //host: { '(document:click)': 'hostClick($event)' },
})
export class PtprofileeditComponent implements OnInit {

//   @ViewChild('dob') dob: any;

//   @ViewChild('startContainer') startContainer: ElementRef;
    
//   hostClick(event) {
//     let startIsOpen: boolean = this.dob.isOpen();   
//     if (startIsOpen) {
//         if (this.startContainer && this.startContainer.nativeElement && !this.startContainer.nativeElement.contains(event.target)) {                
//             console.log("Not in startDate container - closing.");
//             this.dob.close();
//         }
//     }
// }



  public loading = false;
  currentUser: User;
  theHtmlString : string
  editPatientForm: any;
  server_response :string;
  fileToUpload: File = null;
  first_name:string;
  submitted = false;
  modelTime1;
  datea:Date;
  modelTime = {
    year: new Date().getFullYear(),
    month: new Date().getMonth() + 1,
    day: new Date().getDate()
  }

  model;
  
  constructor(private formBuilder: FormBuilder, private router: Router, private angularHttp: AngularHttpProvider) {
    this.theHtmlString ='';
   
    this.editPatientForm = this.formBuilder.group({
      'first_name': ['', [Validators.required]],
      'last_name': ['', [Validators.required]],
      'email': ['', [Validators.required,Validators.email]],
      'dob': ['', []],
      'contact_no': ['', [Validators.required]],
      'address': ['', [Validators.required]],

      'height': ['', [Validators.required]],
      'weight': ['', [Validators.required]],
      //'profile_pic': [''],
      'gender': [''],
      'about': ['']
      

  
      
      //'profile': ['', [Validators.required, Validators.minLength(10)]]
    });

   }
   get f() { return this.editPatientForm.controls; }
   public uploader: FileUploader = new FileUploader({ url: this.angularHttp.API_URL + 'fileUpload.json', itemAlias: localStorage.getItem('user_id') });
  ngOnInit() {

    this.uploader.onAfterAddingFile = (file) => { file.withCredentials = false; };
    this.uploader.onCompleteItem = (item: any, response: any, status: any, headers: any) => {
      //console.log('ImageUpload:uploaded:', item, status, response);
      //alert('File uploaded successfully');
      var data = JSON.parse(response);
      if(data.status==200){
        localStorage.setItem('profile_pic',data.data['img']);
        }
      this.loading = false;
      this.router.navigateByUrl('/myprofile');
    };

    this.getProfile();
    

  }
  
  
editPatient(){
  // let setdate;
  //  setdate = this.editPatientForm.value.dob;

  this.submitted=true;
 // console.log(this.editPatientForm.value);
 // console.log(this.editPatientForm.value);
  if (this.editPatientForm.valid) {  

    // let setdate;
    // let datevalue;
    // if (this.editPatientForm.value.dob) {
    //   setdate = this.editPatientForm.value.dob;
    //   let day;
    //   if (setdate.day <= 9) {
    //     day = '0' + setdate.day;
    //   }
    //   else {
    //     day = setdate.day;
    //   }
    //   let mon;
    //   if (setdate.month <= 9) {
    //     mon = '0' + setdate.month;
    //   } else {
    //     mon = setdate.month;
    //   }

    //   datevalue = setdate.year + '-' + mon + '-' + day;
    // }
   

  var data = {
    user_id : localStorage.getItem('user_id'),
    first_name: this.editPatientForm.value.first_name,
    last_name: this.editPatientForm.value.last_name,
    email : this.editPatientForm.value.email,
    dob : this.editPatientForm.value.dob,
    contact_no : this.editPatientForm.value.contact_no,
    address :this.editPatientForm.value.address,
    height : this.editPatientForm.value.height,
    weight : this.editPatientForm.value.weight,
    gender : this.editPatientForm.value.gender,
    about : this.editPatientForm.value.about,
  };
  
  this.loading = true;
    this.angularHttp.post("editProfile.json", data)
      .toPromise()
      .then((response) => {
        this.server_response = JSON.stringify(response.json());
        var data = JSON.parse(this.server_response);

        if (data.status == 200) {
          //this.currentUser = data.data['patientinfo'][0];myprofile
          if (this.uploader.getNotUploadedItems().length) {
            this.uploader.uploadAll();
          } else {

            this.loading = false;
            this.router.navigateByUrl('/myprofile');
          }
          localStorage.setItem('name',this.editPatientForm.value.first_name+' '+this.editPatientForm.value.last_name )
          //this.router.navigateByUrl('/myprofile');
          //console.log(data);
          this.loading = false;
        }


      })
      .catch((error) => {
        this.server_response = error._body;
        this.loading = false;
      });
    }
  
  

}

  getProfile() {

    
    this.loading = true;
    var pid = localStorage.getItem('user_id');
    this.angularHttp.post("patientDetails.json", { 'user_id': pid })
      .toPromise()
      .then((response) => {
        this.server_response = JSON.stringify(response.json());
        var data = JSON.parse(this.server_response);

        if (data.status == 200) {
          this.currentUser = data.data['patientinfo'][0];
          
          this.loading = false;

          this.datea = new Date(this.currentUser.dob);

          this.modelTime1 = '2018-09-15';
 
          console.log(this.modelTime1);
        }


      })
      .catch((error) => {
        this.server_response = error._body;
        this.loading = false;
      });

  }

}
