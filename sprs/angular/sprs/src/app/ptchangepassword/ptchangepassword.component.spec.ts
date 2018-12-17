import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PtchangepasswordComponent } from './ptchangepassword.component';

describe('PtchangepasswordComponent', () => {
  let component: PtchangepasswordComponent;
  let fixture: ComponentFixture<PtchangepasswordComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PtchangepasswordComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PtchangepasswordComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
