import { Component, OnInit,ElementRef,ViewChild, } from '@angular/core';
import { AngularHttpProvider } from '../angular-http';
import { ReadinglistComponent } from '../readinglist/readinglist.component';
import { User } from '../_models';
import { FormBuilder, Validators } from '@angular/forms';
import { Router } from "@angular/router";
import { extend } from 'webdriver-js-extender';


@Component({
  selector: 'app-readings',
  templateUrl: './readings.component.html',
  styleUrls: ['./readings.component.css'],
  //host: { '(document:click)': 'hostClick($event)' },
})
export class ReadingsComponent  implements OnInit {

//   @ViewChild('formdate') formdate: any;
//   @ViewChild('todate') todate: any;

//   @ViewChild('startContainer') startContainer: ElementRef;
//   @ViewChild('endContainer') endContainer: ElementRef;

    
//   hostClick(event) {
//     let startIsOpen: boolean = this.formdate.isOpen();
//     let endIsOpen: boolean = this.todate.isOpen();

//     if (startIsOpen) {
//         if (this.startContainer && this.startContainer.nativeElement && !this.startContainer.nativeElement.contains(event.target)) {                
//             console.log("Not in startDate container - closing.");
//             this.formdate.close();
//         }
//     }

//     if (endIsOpen) {
//         if (this.endContainer && this.endContainer.nativeElement && !this.endContainer.nativeElement.contains(event.target)) {
//             console.log("Not in endDate container - closing.");
//             this.todate.close();
//         }
//     }
// }
 
  public loading = false;
  constructor(private formBuilder: FormBuilder, private router: Router, private angularHttp: AngularHttpProvider,private progress : ReadinglistComponent) {
    
    
    
    
  }
  public model_todate:Date;
  public model_fromdate:Date;
  currentUser: User;
  theHtmlString: string
  editdrForm: any;
  server_response: string;
  formList: Array<any> = [];
  public selectedDate:Date;
  setFormdate:string;
  settodate:string;
  ngOnInit() {

    this.getptreading();

  }

  onSelect(evt:any){

    // let setFormdate='';
    // let settodate='';
   // this.selectedDate = new Date(evt.year,evt.month-1,evt.day);
   // console.log(this.selectedDate);
  // this.selectedDate = new Date(evt.year,evt.month-1,evt.day);
     let getFormdate = this.model_fromdate.toString();
     if(getFormdate){
    // this.setFormdate = getFormdate['year']+'-'+getFormdate['month']+'-'+getFormdate['day'];
     //console.log('setFormdate'+this.setFormdate);
     this.setFormdate = this.model_fromdate.toString();
     }else{
      this.setFormdate ='';
     }

     let gettodate = this.model_todate.toString();
     if(gettodate){
    // this. settodate = gettodate['year']+'-'+gettodate['month']+'-'+gettodate['day'];
    // console.log('settodate'+this.settodate);
     this. settodate = this.model_todate.toString();
     }
     else{
      this. settodate= '';
     }
     
if(this.settodate != '' || this.setFormdate !=''){

  //console.log(this.setFormdate+'----'+this.settodate);
this.getptreading();

}

  }
  getptreading() {

    if(this.settodate != '' || this.setFormdate !=''){

      //console.log(this.setFormdate+'----'+this.settodate);
      var sendData = { 'user_id': localStorage.getItem('user_id'),'from_date': this.setFormdate,'to_date':this.settodate};

    }else{
      var sendData = { 'user_id': localStorage.getItem('user_id'),'from_date': '','to_date':'' };
    }
    
    this.progress.setLoadingOpen();
    
    this.angularHttp.post("getptreadings.json", sendData)
      .toPromise()
      .then((response) => {
        this.server_response = JSON.stringify(response.json());
        var data = JSON.parse(this.server_response);

        if (data.status == 200) {
          //this.currentUser = data.data['patientinfo'][0];myprofile
          //this.router.navigateByUrl('/profile');
          this.formList = data.data['readinglist'];
         //console.log(this.formList);
          //console.log(this.formList[0].TabledData.colum_value[0]);
        } else {

         this.theHtmlString = data.message;
          console.log(data);
         // this.formList['TabledData']['colum_value'] =[];

        }
        this.progress.setLoadingClose();

      })
      .catch((error) => {
        this.server_response = error._body;
        this.progress.setLoadingClose();
      });

  }


}
