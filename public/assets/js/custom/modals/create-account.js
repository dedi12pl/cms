 "use strict";
    var KTCreateAccount = function() {
        var e, t, i, o, r, s, a = [];
        return {
            init: function() {
                (t = document.querySelector("#kt_modal_create_account")) && (e = new bootstrap.Modal(t)), i =
                    document.querySelector("#kt_create_account_stepper"), o = i.querySelector(
                        "#kt_create_account_form"), r = i.querySelector('[data-kt-stepper-action="submit"]'), (
                        s = new KTStepper(i)).on("kt.stepper.next", (function(e) {
                        console.log("stepper.next");
                        var t = a[e.getCurrentStepIndex() - 1];
                        t ? t.validate().then((function(t) {
                            console.log("validated!"), "Valid" == t ? (e.goNext(), KTUtil
                                .scrollTop()) : Swal.fire({
                                    text: "Opps.. silahkan melengkapi data terlebih dahulu untuk melanjutkan!",
                                    icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, baik!",
                                customClass: {
                                    confirmButton: "btn btn-light"
                                }
                            }).then((function() {
                                KTUtil.scrollTop()
                            }))
                        })) : (e.goNext(), KTUtil.scrollTop())
                    })), s.on("kt.stepper.previous", (function(e) {
                        console.log("stepper.previous"), e.goPrevious(), KTUtil.scrollTop()
                    })), a.push(FormValidation.formValidation(o, {
                        fields: {
                            nama_penyelenggara: {
                                validators: {
                                    notEmpty: {
                                        message: "Kolom nama penyelenggara harus diisi!"
                                    }
                                }
                            },
                            alamat: {
                                validators: {
                                    notEmpty: {
                                        message: "Kolom alamat harus diisi!"
                                    }
                                }
                            },
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger,
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: ".fv-row",
                                eleInvalidClass: "",
                                eleValidClass: ""
                            })
                        }
                    })), a.push(FormValidation.formValidation(o, {
                        fields: {
                            nama_lengkap: {
                                validators: {
                                    notEmpty: {
                                        message: "Kolom nama lengkap harus diisi!"
                                    }
                                }
                            },
                            email: {
                                validators: {
                                    notEmpty: {
                                        message: "Kolom email harus diisi!"
                                    },
                                    emailAddress: {
                                        message: "Harap memasukkan email yang valid!"
                                    }
                                }
                            },
                            username: {
                                validators: {
                                    notEmpty: {
                                        message: "Kolom username harus diisi!"
                                    }
                                }
                            },
                            password: {
                                validators: {
                                    notEmpty: {
                                        message: "Kolom password harus diisi!"
                                    }
                                }
                            },
                            confirm_password: {
                                validators: {
                                    notEmpty: {
                                        message: "Kolom konfirmasi password harus diisi!"
                                    }
                                }
                            }
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger,
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: ".fv-row",
                                eleInvalidClass: "",
                                eleValidClass: ""
                            })
                        }
                    })), r.addEventListener("click", (function(t) {
                        t.preventDefault(), r.disabled = !0, r.setAttribute("data-kt-indicator", "on"),
                            setTimeout((function() {
                                r.removeAttribute("data-kt-indicator"), r.disabled = !1, Swal
                                    .fire({
                                        text: "Data penyelenggara berhasil ditambahkan!",
                                        icon: "success",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, baik!",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    }).then((function(t) {
                                        t.isConfirmed && e && e.hide()
                                    }))
                            }), 2e3)
                    })), $(o.querySelector('[name="card_expiry_month"]')).on("change", (function() {
                        a[3].revalidateField("card_expiry_month")
                    })), $(o.querySelector('[name="card_expiry_year"]')).on("change", (function() {
                        a[3].revalidateField("card_expiry_year")
                    })), $(o.querySelector('[name="business_type"]')).on("change", (function() {
                        a[2].revalidateField("business_type")
                    }))
            }
        }
    }();
    KTUtil.onDOMContentLoaded((function() {
        KTCreateAccount.init()
    }));