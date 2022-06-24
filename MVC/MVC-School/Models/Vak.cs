using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using Microsoft.EntityFrameworkCore;
using System.Collections.Generic;

namespace MVC_School.Models
{
    public class Vak
    {
        public Vak()
        {
            VakStudenten = new HashSet<VakStudent>();
        }
        public int Id { get; set; }

        [StringLength(20)]
        public string Naam { get; set; }

        [ForeignKey("Docenten")]
        public int DocentId { get; set; }

        public virtual Docent Docent { get; set; }

        public ICollection<VakStudent> VakStudenten { get; set; }
    }
}
