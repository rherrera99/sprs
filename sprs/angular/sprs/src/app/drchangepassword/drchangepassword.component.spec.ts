import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DrchangepasswordComponent } from './drchangepassword.component';

describe('DrchangepasswordComponent', () => {
  let component: DrchangepasswordComponent;
  let fixture: ComponentFixture<DrchangepasswordComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DrchangepasswordComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DrchangepasswordComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
