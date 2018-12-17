import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { MainafterloginComponent } from './mainafterlogin.component';

describe('MainafterloginComponent', () => {
  let component: MainafterloginComponent;
  let fixture: ComponentFixture<MainafterloginComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ MainafterloginComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(MainafterloginComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
