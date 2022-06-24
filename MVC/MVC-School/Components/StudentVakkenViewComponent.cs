using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace MVC_School.Data
{
    public class StudentVakkenViewComponent : ViewComponent
    {
        private readonly SchoolDbContext _context;

        public StudentVakkenViewComponent(SchoolDbContext context)
        {
            _context = context;
        }

        public async Task<IViewComponentResult> InvokeAsync(int id)
        {
            var vakstudent = await _context.VakStudenten
                .Include(a => a.Student)
                .Include(a => a.Vak)
                .ThenInclude(d => d.Docent)
                .Where(x => x.VakId == id)
                .ToListAsync();
            return View(vakstudent);
        }
    }
}
