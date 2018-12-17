import { Component, OnInit ,Injectable} from '@angular/core';
//import { ActivatedRoute } from "@angular/router";
//import { AngularHttpProvider } from '../angular-http';

@Component({
  selector: 'app-readinglist',
  templateUrl: './readinglist.component.html',
  styleUrls: ['./readinglist.component.css']
})
@Injectable()
export class ReadinglistComponent implements OnInit {

  public loading = false;
  constructor() { 
//this.loading=false;
//alert(this.loading);
    

  }

  ngOnInit() {
    this.loading = false;
    
  }

 setLoadingOpen(){

    this.loading = true;
  }
  get getLoading(){

    return this.loading;
  }
 setLoadingClose(){

    this.loading = false;
  }

}
