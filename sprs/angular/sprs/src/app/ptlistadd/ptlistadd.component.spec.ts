import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PtlistaddComponent } from './ptlistadd.component';

describe('PtlistaddComponent', () => {
  let component: PtlistaddComponent;
  let fixture: ComponentFixture<PtlistaddComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PtlistaddComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PtlistaddComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
